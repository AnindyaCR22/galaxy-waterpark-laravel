<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; // <--- Import Facade Storage untuk manajemen file

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'level'    => 'required|in:admin,user',
            'photo'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file gambar
        ]);

        $photoPath = null;

        // Mengecek apakah user mengunggah berkas foto
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            
            // Format nama unik: namafile_timestamp.ext
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;
            
            // Simpan ke storage/app/public/photos
            $photoPath = $file->storeAs('photos', $filenameSimpan, 'public');
        }

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'level'    => $request->level,
            'photo'    => $photoPath, // Simpan path foto ke database
        ]);

        return redirect()->route('users.index')->with('success', 'User dan foto profil berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'level' => 'required|in:admin,user',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'level' => $request->level,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Fitur Unggah Ulang / Edit Gambar: Hapus foto lama jika ada foto baru yang diunggah
        if ($request->hasFile('photo')) {
            // Hapus berkas foto lama dari direktori storage
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            $file = $request->file('photo');
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;

            $data['photo'] = $file->storeAs('photos', $filenameSimpan, 'public');
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Data user dan foto berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (auth()->id() == $user->id) {
            return redirect()->route('users.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        // Hapus file foto dari disk storage sebelum menghapus data dari database
        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User dan foto berhasil dihapus.');
    }
}