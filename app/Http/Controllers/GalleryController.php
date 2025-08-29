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
        if ($request->has('category') && $request->category) {
            $query->where('category_gallery_id', $request->category);
        }

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%');
            });
        }

        $galleries = $query->orderByPubDate()->paginate(12);
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:750',
            'pub_date' => 'nullable|date',
            'url' => 'nullable|url',
            'category_gallery_id' => 'nullable|exists:gallery_categories,id',
            'display_on_home' => 'boolean',
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('gallery', $imageName, 'public');
            $data['image'] = $imagePath;
        }

        $data['display_on_home'] = $request->has('display_on_home') ? true : false;

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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pub_date' => 'nullable|date',
            'url' => 'nullable|url',
            'category_gallery_id' => 'required|exists:gallery_categories,id',
            'display_on_home' => 'boolean',
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                Storage::disk('public')->delete($gallery->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('gallery', $imageName, 'public');
            $data['image'] = $imagePath;
        }

        $data['display_on_home'] = $request->has('display_on_home') ? true : false;

        $gallery->update($data);

        return redirect()->route('gallery.index')->with('success', 'Gallery item updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        // Delete image if exists
        if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        return redirect()->route('gallery.index')->with('success', 'Gallery item deleted successfully!');
    }

    /**
     * Display gallery items for home page.
     */
    public function home()
    {
        $galleries = Gallery::with('category')
            ->displayOnHome()
            ->orderByPubDate()
            ->limit(100)
            ->get();

        return view('gallery.home', compact('galleries'));
    }

    /**
     * Display gallery items by category.
     */
    public function byCategory($id)
    {
        // Validate that the category exists
        $category = CategoryGallery::findOrFail($id);

        $galleries = Gallery::with('category')
            ->where('category_gallery_id', $id)
            ->orderByPubDate() // Use consistent ordering
            ->paginate(12); // Add pagination like in index method

        $categories = CategoryGallery::all();

        return view('gallery.index', compact('galleries', 'categories'));
    }
}
