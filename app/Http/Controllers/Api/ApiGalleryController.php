<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\CategoryGallery;
use Illuminate\Http\Request;

class ApiGalleryController extends Controller
{
    /**
     * Get all galleries with optional filters (search, category)
     */
    public function index(Request $request)
    {
        $query = Gallery::with('category');

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category_gallery_id', $request->category);
        }

        // Search by title
        if ($request->has('search') && $request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $galleries = $query->orderBy('pub_date', 'desc')->paginate(12);

        // Tambahkan full URL image
        $galleries->getCollection()->transform(function ($item) {
            $item->image_url = $item->image ? url('storage/' . $item->image) : null;
            return $item;
        });

        return response()->json([
            'status' => true,
            'message' => 'Data gallery berhasil diambil',
            'data' => $galleries
        ], 200);
    }

    /**
     * Get single gallery detail
     */
    public function show($id)
    {
        $gallery = Gallery::with('category')->find($id);

        if (!$gallery) {
            return response()->json([
                'status' => false,
                'message' => 'Gallery tidak ditemukan'
            ], 404);
        }

        $gallery->image_url = $gallery->image ? url('storage/' . $gallery->image) : null;

        return response()->json([
            'status' => true,
            'message' => 'Detail gallery berhasil diambil',
            'data' => $gallery
        ], 200);
    }

    /**
     * Get galleries for home page (display_on_home = true)
     */
    public function home()
    {
        $galleries = Gallery::with('category')
            ->where('display_on_home', true)
            ->orderBy('pub_date', 'desc')
            ->limit(100)
            ->get();

        // Tambahkan full URL image
        $galleries->transform(function ($item) {
            $item->image_url = $item->image ? url('storage/' . $item->image) : null;
            return $item;
        });

        return response()->json([
            'status' => true,
            'message' => 'Data gallery untuk home berhasil diambil',
            'data' => $galleries
        ], 200);
    }

    /**
     * Get galleries by category ID
     */
    public function byCategory($id)
    {
        $category = CategoryGallery::find($id);
        if (!$category) {
            return response()->json([
                'status' => false,
                'message' => 'Kategori tidak ditemukan'
            ], 404);
        }

        $galleries = Gallery::with('category')
            ->where('category_gallery_id', $id)
            ->orderBy('pub_date', 'desc')
            ->paginate(12);

        $galleries->getCollection()->transform(function ($item) {
            $item->image_url = $item->image ? url('storage/' . $item->image) : null;
            return $item;
        });

        return response()->json([
            'status' => true,
            'message' => 'Data gallery berdasarkan kategori berhasil diambil',
            'category' => $category,
            'data' => $galleries
        ], 200);
    }
}
