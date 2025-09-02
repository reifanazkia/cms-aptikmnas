<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    /**
     * Tampilkan semua data About
     */
    public function index()
    {
        $abouts = About::latest()->get();
        return view('about.index', compact('abouts'));
    }

    /**
     * Tampilkan form create
     */
    public function create()
    {
        return view('about.create');
    }

    /**
     * Simpan data baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'image2' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = $request->file('image')->store('about', 'public');
        $image2Path = $request->file('image2')->store('about', 'public');

        About::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image' => $imagePath,
            'image2' => $image2Path,
        ]);

        return redirect()->route('about.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Tampilkan form edit
     */
    public function edit($id)
    {
        $about = About::findOrFail($id);
        return view('about.edit', compact('about'));
    }

    /**
     * Update data
     */
    public function update(Request $request, $id)
    {
        $about = About::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image2' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'title' => $validated['title'],
            'description' => $validated['description'],
        ];

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($about->image);
            $data['image'] = $request->file('image')->store('about', 'public');
        }

        if ($request->hasFile('image2')) {
            Storage::disk('public')->delete($about->image2);
            $data['image2'] = $request->file('image2')->store('about', 'public');
        }

        $about->update($data);

        return redirect()->route('about.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Hapus data
     */
    public function destroy($id)
    {
        $about = About::findOrFail($id);

        Storage::disk('public')->delete([$about->image, $about->image2]);

        $about->delete();

        return redirect()->route('about.index')->with('success', 'Data berhasil dihapus');
    }
}
