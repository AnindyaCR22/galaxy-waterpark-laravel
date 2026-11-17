<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TiketController extends Controller
{
    // 1. READ: Tampilkan data dengan Pagination
    public function index()
    {
        $batas = 5; // Batas 5 data per halaman
        $jumlah_tiket = Tiket::count();
        $data_tiket = Tiket::orderBy('id', 'desc')->paginate($batas);
        $no = $batas * ($data_tiket->currentPage() - 1);

        return view('tiket.index', compact('data_tiket', 'no', 'jumlah_tiket'));
    }

    // 2. CREATE: Form Tambah
    public function create()
    {
        return view('tiket.create');
    }

    // 3. STORE: Simpan dengan Validasi, SEO Slug, & Upload Foto
    public function store(Request $request)
    {
        $messages = [
            'required' => 'Kolom :attribute wajib diisi!',
            'numeric'  => 'Kolom :attribute harus berupa angka!',
            'date'     => 'Kolom :attribute harus berformat tanggal yang valid!',
            'max'      => 'Kolom :attribute tidak boleh lebih dari :max karakter/KB!',
            'image'    => 'Kolom :attribute harus berupa file gambar!',
            'mimes'    => 'Format :attribute harus jpeg, png, atau jpg!',
        ];

        $attributes = [
            'nama'        => 'Nama Tiket',
            'kategori'    => 'Kategori',
            'harga'       => 'Harga',
            'tgl_berlaku' => 'Tanggal Berlaku',
            'foto'        => 'Foto Utama Tiket',
        ];

        $request->validate([
            'nama'        => 'required|string|max:100',
            'kategori'    => 'required|string',
            'harga'       => 'required|numeric',
            'tgl_berlaku' => 'nullable|date',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], $messages, $attributes);

        $fotoName = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fotoName = time() . '_' . Str::slug($request->nama) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('tiket', $fotoName, 'public');
        }

        Tiket::create([
            'nama'        => $request->nama,
            'tiket_seo'   => Str::slug($request->nama),
            'foto'        => $fotoName,
            'kategori'    => $request->kategori,
            'harga'       => $request->harga,
            'tgl_berlaku' => $request->tgl_berlaku,
        ]);

        return redirect('/tiket')->with('pesan', 'Data Tiket Berhasil Disimpan');
    }

    // 4. EDIT: Form Edit
    public function edit($id)
    {
        $tiket = Tiket::findOrFail($id);
        return view('tiket.edit', compact('tiket'));
    }

    // 5. UPDATE: Update Data, Slug SEO, & Pembersihan Foto Lama
    public function update(Request $request, $id)
    {
        $messages = [
            'required' => 'Kolom :attribute wajib diisi!',
            'numeric'  => 'Kolom :attribute harus berupa angka!',
            'date'     => 'Kolom :attribute harus berformat tanggal yang valid!',
            'max'      => 'Kolom :attribute tidak boleh lebih dari :max karakter/KB!',
            'image'    => 'Kolom :attribute harus berupa file gambar!',
            'mimes'    => 'Format :attribute harus jpeg, png, atau jpg!',
        ];

        $attributes = [
            'nama'        => 'Nama Tiket',
            'kategori'    => 'Kategori',
            'harga'       => 'Harga',
            'tgl_berlaku' => 'Tanggal Berlaku',
            'foto'        => 'Foto Utama Tiket',
        ];

        $request->validate([
            'nama'        => 'required|string|max:100',
            'kategori'    => 'required|string',
            'harga'       => 'required|numeric',
            'tgl_berlaku' => 'nullable|date',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], $messages, $attributes);

        $tiket = Tiket::findOrFail($id);

        $data = [
            'nama'        => $request->nama,
            'tiket_seo'   => Str::slug($request->nama),
            'kategori'    => $request->kategori,
            'harga'       => $request->harga,
            'tgl_berlaku' => $request->tgl_berlaku,
        ];

        if ($request->hasFile('foto')) {
            if ($tiket->foto && Storage::disk('public')->exists('tiket/' . $tiket->foto)) {
                Storage::disk('public')->delete('tiket/' . $tiket->foto);
            }
            $file = $request->file('foto');
            $fotoName = time() . '_' . Str::slug($request->nama) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('tiket', $fotoName, 'public');
            $data['foto'] = $fotoName;
        }

        $tiket->update($data);

        return redirect('/tiket')->with('pesan', 'Data Tiket Berhasil Diperbarui');
    }

    // 6. DELETE: Hapus Data & Bersihkan Foto Fisik
    public function destroy($id)
    {
        $tiket = Tiket::findOrFail($id);

        if ($tiket->foto && Storage::disk('public')->exists('tiket/' . $tiket->foto)) {
            Storage::disk('public')->delete('tiket/' . $tiket->foto);
        }

        $tiket->delete();

        return redirect('/tiket')->with('pesan', 'Data Tiket Berhasil Dihapus');
    }

    // 7. SEARCH: Fitur Pencarian Data
    public function search(Request $request)
    {
        $batas = 5;
        $cari = $request->kata;

        $data_tiket = Tiket::where('nama', 'like', "%" . $cari . "%")
            ->orWhere('kategori', 'like', "%" . $cari . "%")
            ->paginate($batas);

        $jumlah_tiket = $data_tiket->total();
        $no = $batas * ($data_tiket->currentPage() - 1);

        return view('tiket.search', compact('jumlah_tiket', 'data_tiket', 'no', 'cari'));
    }

    // 8. KATALOG TIKET (Tugas 2 Modul BAB X: Halaman list_tiket)
    public function listTiket()
    {
        $tikets = Tiket::latest()->get();
        return view('tiket.list_tiket', compact('tikets'));
    }

    // 9. DETAIL GALERI BERBASIS SEO SLUG (Tugas 3c Modul BAB X: galtiket)
    public function galtiket($title)
    {
        $tiket = Tiket::where('tiket_seo', $title)->firstOrFail();
        $galeris = $tiket->photos()->orderBy('id', 'desc')->paginate(6);

        return view('tiket.galeri-tiket', compact('tiket', 'galeris'));
    }
}