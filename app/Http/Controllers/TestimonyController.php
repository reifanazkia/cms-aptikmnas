<?php

namespace App\Http\Controllers;

use App\Models\CategoryDaftar;
use App\Models\Testimony;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonyController extends Controller
{
    public function index(Request $request)
    {
        $testimonies = Testimony::with('category')->latest()->paginate(10);

        if ($request->has('search') && !empty($request->search)) {
            $testimonies->where('title', 'like', '%' . $request->search . '%');
        }

        return view('testimonies.index', compact('testimonies'));
    }

    public function create()
    {
        $categories = CategoryDaftar::select('id', 'name')->get();
        return view('testimonies.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'display_homepage' => 'nullable|boolean',
            'category_dpd_id' => 'nullable|exists:daftar_dpd_categories,id',
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:750'
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('testimonies'), $imageName);

        Testimony::create([
            'display_homepage' => $request->has('display_homepage'),
            'category_dpd_id' => $request->category_dpd_id,
            'name' => $request->name,
            'title' => $request->title,
            'description' => $request->description,
            'image' => 'testimonies/' . $imageName
        ]);

        return redirect()->route('testimonies.index')->with('success', 'Testimony berhasil ditambahkan.');
    }

    public function edit(Testimony $testimony)
    {
        $categories = CategoryDaftar::select('id', 'name')->get();
        return view('testimonies.edit', compact('testimony', 'categories'));
    }

    public function update(Request $request, Testimony $testimony)
    {
        $request->validate([
            'display_homepage' => 'nullable|boolean',
            'category_dpd_id' => 'nullable|exists:daftar_dpd_categories,id',
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:750',
        ]);

        $data = $request->only(['display_homepage', 'category_dpd_id', 'name', 'title', 'description']);
        $data['display_homepage'] = $request->has('display_homepage');

        if ($request->hasFile('image')) {
            if ($testimony->image && file_exists(public_path($testimony->image))) {
                unlink(public_path($testimony->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('testimonies'), $imageName);
            $data['image'] = 'testimonies/' . $imageName;
        }

        $testimony->update($data);

        return redirect()->route('testimonies.index')->with('success', 'Testimony berhasil diupdate.');
    }

    public function destroy(Testimony $testimony)
    {
        if ($testimony->image && file_exists(public_path($testimony->image))) {
            unlink(public_path($testimony->image));
        }

        $testimony->delete();
        return redirect()->route('testimonies.index')->with('success', 'Testimony berhasil dihapus.');
    }
}
