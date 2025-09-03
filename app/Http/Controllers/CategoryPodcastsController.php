<?php

namespace App\Http\Controllers;

use App\Models\CategoryPodcasts;
use Illuminate\Http\Request;

class CategoryPodcastsController extends Controller
{
    public function index(Request $request)
    {
        $podcats = CategoryPodcasts::latest()->get();

        if ($request->has('search') && !empty($request->search)) {
            $podcats->where('name', 'like', '%' . $request->search . '%');
        }

        return view('category-podcasts.index', compact('podcats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        CategoryPodcasts::create($request->only('name'));

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $podcats = CategoryPodcasts::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $podcats->update($request->only('name'));

        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $podcats = CategoryPodcasts::findOrFail($id);
        $podcats->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus');
    }
}
