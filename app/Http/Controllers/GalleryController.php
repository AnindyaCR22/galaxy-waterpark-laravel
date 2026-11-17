<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Post::where('picture', '!=', '')
            ->whereNotNull('picture')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'picture' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('picture')) {
            $extension = $request->file('picture')->getClientOriginalExtension();
            $filenameSimpan = uniqid() . time() . '.' . $extension;
            $request->file('picture')->storeAs('posts_image', $filenameSimpan, 'public');
        } else {
            $filenameSimpan = 'noimage.png';
        }

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'picture' => $filenameSimpan,
        ]);

        return redirect()->route('gallery.index')->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $gallery = Post::findOrFail($id);
        return view('gallery.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        $gallery = Post::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
        ];

        if ($request->hasFile('picture')) {
            if ($gallery->picture && Storage::disk('public')->exists('posts_image/' . $gallery->picture)) {
                Storage::disk('public')->delete('posts_image/' . $gallery->picture);
            }
            $extension = $request->file('picture')->getClientOriginalExtension();
            $filenameSimpan = uniqid() . time() . '.' . $extension;
            $request->file('picture')->storeAs('posts_image', $filenameSimpan, 'public');
            $data['picture'] = $filenameSimpan;
        }

        $gallery->update($data);
        return redirect()->route('gallery.index')->with('success', 'Foto galeri berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $gallery = Post::findOrFail($id);

        if ($gallery->picture && Storage::disk('public')->exists('posts_image/' . $gallery->picture)) {
            Storage::disk('public')->delete('posts_image/' . $gallery->picture);
        }

        $gallery->delete();
        return redirect()->route('gallery.index')->with('success', 'Foto galeri berhasil dihapus.');
    }
}