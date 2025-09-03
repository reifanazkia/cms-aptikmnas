<?php

namespace App\Http\Controllers;

use App\Models\CategoryGallery;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Gallery::with('category');

        // Filter by category if provided
        if ($request->filled('category')) {
            $query->where('category_gallery_id', $request->category);
        }

        // Search functionality
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $galleries = $query->orderBy('pub_date', 'desc')->paginate(12);
        $categories = CategoryGallery::all();

        return view('gallery.index', compact('galleries', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CategoryGallery::all();
        return view('gallery.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'               => 'required|string|max:255',
            'description'         => 'nullable|string',
            'image'               => 'nullable|image|mimes:jpg,jpeg,png,webp|max:750',
            'pub_date'            => 'nullable|date',
            'waktu_baca'          => 'required|string|max:255',
            'category_gallery_id' => 'required|exists:gallery_categories,id',
        ]);

        $data = $request->only(['title','description','pub_date','waktu_baca','category_gallery_id']);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image      = $request->file('image');
            $imageName  = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $imagePath  = $image->storeAs('gallery', $imageName, 'public');
            $data['image'] = $imagePath;
        }

        Gallery::create($data);

        return redirect()->route('gallery.index')->with('success', 'Gallery item created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        $gallery->load('category');
        return view('gallery.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        $categories = CategoryGallery::all();
        return view('gallery.edit', compact('gallery', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title'               => 'required|string|max:255',
            'description'         => 'nullable|string',
            'image'               => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'pub_date'            => 'nullable|date',
            'waktu_baca'          => 'required|string|max:255',
            'category_gallery_id' => 'required|exists:gallery_categories,id',
        ]);

        $data = $request->only(['title','description','pub_date','waktu_baca','category_gallery_id']);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                Storage::disk('public')->delete($gallery->image);
            }

            $image      = $request->file('image');
            $imageName  = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $imagePath  = $image->storeAs('gallery', $imageName, 'public');
            $data['image'] = $imagePath;
        }

        $gallery->update($data);

        return redirect()->route('gallery.index')->with('success', 'Gallery item updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        return redirect()->route('gallery.index')->with('success', 'Gallery item deleted successfully!');
    }

    /**
     * Display gallery items by category.
     */
    public function byCategory($id)
    {
        $category = CategoryGallery::findOrFail($id);

        $galleries = Gallery::with('category')
            ->where('category_gallery_id', $id)
            ->orderBy('pub_date', 'desc')
            ->paginate(12);

        $categories = CategoryGallery::all();

        return view('gallery.index', compact('galleries', 'categories'));
    }
}
