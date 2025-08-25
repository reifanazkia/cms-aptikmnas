<?php

namespace App\Http\Controllers;

use App\Models\CategoryPengurus;
use Illuminate\Http\Request;

class CategoryPengurusController extends Controller
{
    public function index()
    {
        $pengurus = CategoryPengurus::latest()->get();
        return view('category-pengurus.index', compact('pengurus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'image'  => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'notlp'  => 'required|string|max:20',
            'email'  => 'required|email|max:255',
            'yt'     => 'nullable|string|max:255',
            'fb'     => 'nullable|string|max:255',
            'ig'     => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
        ]);

        $data = $request->only(['name','notlp','email','yt','fb','ig','tiktok']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('pengurus', 'public');
        }

        CategoryPengurus::create($data);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $pengurus = CategoryPengurus::findOrFail($id);

        $request->validate([
            'name'   => 'required|string|max:255',
            'image'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'notlp'  => 'required|string|max:20',
            'email'  => 'required|email|max:255',
            'yt'     => 'nullable|string|max:255',
            'fb'     => 'nullable|string|max:255',
            'ig'     => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
        ]);

        $data = $request->only(['name','notlp','email','yt','fb','ig','tiktok']);

        if ($request->hasFile('image')) {
            // hapus file lama kalau ada
            if ($pengurus->image && file_exists(storage_path('app/public/' . $pengurus->image))) {
                unlink(storage_path('app/public/' . $pengurus->image));
            }
            $data['image'] = $request->file('image')->store('pengurus', 'public');
        }

        $pengurus->update($data);

        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $pengurus = CategoryPengurus::findOrFail($id);

        if ($pengurus->image && file_exists(storage_path('app/public/' . $pengurus->image))) {
            unlink(storage_path('app/public/' . $pengurus->image));
        }

        $pengurus->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus');
    }
}
