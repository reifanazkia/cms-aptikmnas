<?php

namespace App\Http\Controllers;

use App\Models\CategoryGallery;
use Illuminate\Http\Request;

class CategoryGalleryController extends Controller
{
    public function index()
    {
        $gallery = CategoryGallery::latest()->get();
        return view('category-gallery.index', compact('gallery'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        CategoryGallery::create($request->only('name'));

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $gallery = CategoryGallery::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $gallery->update($request->only('name'));

        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $gallery = CategoryGallery::findOrFail($id);
        $gallery->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus');
    }
}
