<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\CategoryKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{

    public function index()
    {
        $kegiatans = Kegiatan::with('category')->latest()->get();
        $categories = CategoryKegiatan::all();

        return view('kegiatan.index', compact('kegiatans', 'categories'));
    }

    public function show($id)
    {
        $kegiatan = Kegiatan::with('category')->findOrFail($id);
        return view('kegiatan.show', compact('kegiatan'));
    }

    public function create()
    {
        $categories = CategoryKegiatan::all();
        return view('kegiatan.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_kegiatan_id' => 'required|exists:kegiatan_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = $request->file('image')->store('kegiatan', 'public');

        Kegiatan::create([
            'category_kegiatan_id' => $request->category_kegiatan_id,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $categories = CategoryKegiatan::all();
        return view('kegiatan.edit', compact('kegiatan', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $request->validate([
            'category_kegiatan_id' => 'required|exists:kegiatan_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $updateData = [
            'category_kegiatan_id' => $request->category_kegiatan_id,
            'title' => $request->title,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            if ($kegiatan->image && Storage::disk('public')->exists($kegiatan->image)) {
                Storage::disk('public')->delete($kegiatan->image);
            }
            $imagePath = $request->file('image')->store('kegiatan', 'public');
            $updateData['image'] = $imagePath;
        }

        $kegiatan->update($updateData);

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil diupdate');
    }

    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        if ($kegiatan->image && Storage::disk('public')->exists($kegiatan->image)) {
            Storage::disk('public')->delete($kegiatan->image);
        }

        $kegiatan->delete();

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil Di Hapus');
}

}
