<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    public function index()
    {
        $jobs = JobVacancy::latest()->get();
        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'           => 'required|string|max:255',
            'company'         => 'required|string|max:255',
            'location'        => 'required|string|max:255',
            'salary'          => 'nullable|numeric',
            'jenis_pekerjaan' => 'required|string',
            'description'     => 'required|string',
            'logo'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;

            $logoPath = $file->storeAs('logos', $filenameSimpan, 'public');
        }

        JobVacancy::create([
            'title'           => $request->title,
            'company'         => $request->company,
            'location'        => $request->location,
            'salary'          => $request->salary,
            'jenis_pekerjaan' => $request->jenis_pekerjaan,
            'description'     => $request->description,
            'logo'            => $logoPath,
        ]);

        return redirect()->route('jobs.index')->with('success', 'Lowongan pekerjaan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $job = JobVacancy::findOrFail($id);
        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, $id)
    {
        $job = JobVacancy::findOrFail($id);

        $request->validate([
            'title'           => 'required|string|max:255',
            'company'         => 'required|string|max:255',
            'location'        => 'required|string|max:255',
            'salary'          => 'nullable|numeric',
            'jenis_pekerjaan' => 'required|string',
            'description'     => 'required|string',
            'logo'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'title'           => $request->title,
            'company'         => $request->company,
            'location'        => $request->location,
            'salary'          => $request->salary,
            'jenis_pekerjaan' => $request->jenis_pekerjaan,
            'description'     => $request->description,
        ];

        // Hapus logo lama dari storage jika ada logo baru yang diunggah
        if ($request->hasFile('logo')) {
            if ($job->logo && Storage::disk('public')->exists($job->logo)) {
                Storage::disk('public')->delete($job->logo);
            }

            $file = $request->file('logo');
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;

            $data['logo'] = $file->storeAs('logos', $filenameSimpan, 'public');
        }

        $job->update($data);

        return redirect()->route('jobs.index')->with('success', 'Data lowongan kerja berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $job = JobVacancy::findOrFail($id);

        // Hapus berkas fisik logo di folder storage
        if ($job->logo && Storage::disk('public')->exists($job->logo)) {
            Storage::disk('public')->delete($job->logo);
        }

        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Lowongan pekerjaan berhasil dihapus.');
    }
}