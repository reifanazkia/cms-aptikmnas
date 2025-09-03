<?php

namespace App\Http\Controllers;

use App\Models\Podcast;
use App\Models\CategoryPodcasts;
use Illuminate\Http\Request;

class PodcastController extends Controller
{
    /**
     * Tampilkan semua podcast
     */
    public function index()
    {
        $podcasts = Podcast::with('category')->latest()->paginate(10);
        return view('podcasts.index', compact('podcasts'));
    }

    /**
     * Tampilkan form tambah podcast
     */
    public function create()
    {
        $categories = CategoryPodcasts::all();
        return view('podcasts.create', compact('categories'));
    }

    /**
     * Simpan podcast baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'                => 'required|string|max:255',
            'description'          => 'required|string',
            'yt_id'                => 'required|string|max:255',
            'pub_date'             => 'required|date',
            'pembicara'            => 'required|array',
            'category_podcasts_id' => 'required|exists:category_podcasts,id',
        ]);

        Podcast::create([
            'title'                => $validated['title'],
            'description'          => $validated['description'] ?? null,
            'yt_id'                => $validated['yt_id'] ?? null,
            'pub_date'             => $validated['pub_date'] ?? null,
            'pembicara'            => $validated['pembicara'] ?? [],
            'category_podcasts_id' => $validated['category_podcasts_id'],
        ]);

        return redirect()->route('podcasts.index')->with('success', 'Podcast berhasil ditambahkan');
    }

    /**
     * Detail podcast
     */
    public function show($id)
    {
        $podcast = Podcast::with('category')->findOrFail($id);
        return view('podcasts.show', compact('podcast'));
    }

    /**
     * Tampilkan form edit
     */
    public function edit($id)
    {
        $podcast    = Podcast::findOrFail($id);
        $categories = CategoryPodcasts::all();
        return view('podcasts.edit', compact('podcast', 'categories'));
    }

    /**
     * Update podcast
     */
    public function update(Request $request, $id)
    {
        $podcast = Podcast::findOrFail($id);

        $validated = $request->validate([
            'title'                => 'required|string|max:255',
            'description'          => 'required|string',
            'yt_id'                => 'required|string|max:255',
            'pub_date'             => 'required|date',
            'pembicara'            => 'required|array',
            'category_podcasts_id' => 'required|exists:category_podcasts,id',
        ]);

        $podcast->update([
            'title'                => $validated['title'],
            'description'          => $validated['description'] ?? null,
            'yt_id'                => $validated['yt_id'] ?? null,
            'pub_date'             => $validated['pub_date'] ?? null,
            'pembicara'            => $validated['pembicara'] ?? [],
            'category_podcasts_id' => $validated['category_podcasts_id'],
        ]);

        return redirect()->route('podcasts.index')->with('success', 'Podcast berhasil diperbarui');
    }

    /**
     * Hapus podcast
     */
    public function destroy($id)
    {
        $podcast = Podcast::findOrFail($id);
        $podcast->delete();

        return redirect()->route('podcasts.index')->with('success', 'Podcast berhasil dihapus');
    }
}
