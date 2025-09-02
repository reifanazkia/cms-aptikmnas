<?php

namespace App\Http\Controllers;

use App\Models\CategoryAboutus;
use Illuminate\Http\Request;

class CategoryAboutusController extends Controller
{
    public function index()
    {
        $kegiatan = CategoryAboutus::latest()->get();
        return view('category-aboutus.index', compact('kegiatan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        CategoryAboutus::create($request->only('name'));

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $kegiatan = CategoryAboutus::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $kegiatan->update($request->only('name'));

        return redirect()->back()->with('success', 'Data berhasil terupdate');
    }

    public function destroy($id)
    {
        $kegiatan = CategoryAboutus::findOrFail($id);
        $kegiatan->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
