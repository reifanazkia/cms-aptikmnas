<?php

namespace App\Http\Controllers;

use App\Models\CategoryStore;
use Illuminate\Http\Request;

class CategoryStoreController extends Controller
{
    public function index(Request $request)
    {
        // Ubah variabel dari $store ke $kegiatan agar sesuai dengan view
        $kegiatan = CategoryStore::latest()->get();

        if ($request->has('search') && !empty($request->search)) {
            $kegiatan->where('title', 'like', '%' . $request->search . '%');
        }

        return view('category-store.index', compact('kegiatan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        CategoryStore::create($request->only('name'));

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $store = CategoryStore::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $store->update($request->only('name'));

        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $store = CategoryStore::findOrFail($id);
        $store->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus');
    }
}
