<?php

namespace App\Http\Controllers;

use App\Models\CategoryDaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryDaftarDPDController extends Controller
{
    // Menampilkan semua data
    public function index(Request $request)
    {
        $categories = CategoryDaftar::latest()->get();

        if ($request->has('search') && !empty($request->search)) {
            $categories->where('name', 'like', '%' . $request->search . '%');
        }

        return view('category-daftar.index', compact('categories'));
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'image'  => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'notlp'  => 'nullable|regex:/^[0-9]+$/|max:20',
            'email'  => 'nullable|email|max:255',
            'yt'     => 'nullable|string|max:255',
            'fb'     => 'nullable|string|max:255',
            'ig'     => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
        ]);

        // Upload file gambar
        $path = $request->file('image')->store('daftar-dpd-categories', 'public');

        CategoryDaftar::create([
            'name'   => $request->name,
            'image'  => $path,
            'notlp'  => $request->notlp,
            'email'  => $request->email,
            'yt'     => $request->yt,
            'fb'     => $request->fb,
            'ig'     => $request->ig,
            'tiktok' => $request->tiktok,
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan');
    }

    // Update data
    public function update(Request $request, $id)
    {
        $category = CategoryDaftar::findOrFail($id);

        $request->validate([
            'name'   => 'required|string|max:255',
            'image'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'notlp'  => 'nullable|regex:/^[0-9]+$/|max:20',
            'email'  => 'nullable|email|max:255',
            'yt'     => 'nullable|string|max:255',
            'fb'     => 'nullable|string|max:255',
            'ig'     => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
        ]);

        $data = $request->only(['name', 'notlp', 'email', 'yt', 'fb', 'ig', 'tiktok']);

        // Jika upload gambar baru, hapus gambar lama
        if ($request->hasFile('image')) {
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }
            $data['image'] = $request->file('image')->store('daftar-dpd-categories', 'public');
        }

        $category->update($data);

        return redirect()->back()->with('success', 'Kategori berhasil diperbarui');
    }

    // Hapus data
    public function destroy($id)
    {
        $category = CategoryDaftar::findOrFail($id);

        // Hapus file gambar
        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus');
    }
}
