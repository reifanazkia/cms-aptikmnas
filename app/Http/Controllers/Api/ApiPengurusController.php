<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengurus;
use Illuminate\Http\Request;

class ApiPengurusController extends Controller
{
    /**
     * Get all Pengurus with optional search filter
     */
    public function index(Request $request)
    {
        $query = Pengurus::with(['categoryDaftar', 'categoryPengurus']);

        // Search by title
        if ($request->has('search') && $request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $pengurus = $query->orderBy('created_at', 'desc')->paginate(12);

        // Tambahkan full URL image untuk semua gambar (image, image2, image3, image4)
        $pengurus->getCollection()->transform(function ($item) {
            $item->image_url  = $item->image ? url('storage/' . $item->image) : null;
            $item->image2_url = $item->image2 ? url('storage/' . $item->image2) : null;
            $item->image3_url = $item->image3 ? url('storage/' . $item->image3) : null;
            $item->image4_url = $item->image4 ? url('storage/' . $item->image4) : null;
            return $item;
        });

        return response()->json([
            'status' => true,
            'message' => 'Data pengurus berhasil diambil',
            'data' => $pengurus
        ], 200);
    }

    /**
     * Get single Pengurus detail
     */
    public function show($id)
    {
        $pengurus = Pengurus::with(['categoryDaftar', 'categoryPengurus'])->find($id);

        if (!$pengurus) {
            return response()->json([
                'status' => false,
                'message' => 'Pengurus tidak ditemukan'
            ], 404);
        }

        $pengurus->image_url  = $pengurus->image ? url('storage/' . $pengurus->image) : null;
        $pengurus->image2_url = $pengurus->image2 ? url('storage/' . $pengurus->image2) : null;
        $pengurus->image3_url = $pengurus->image3 ? url('storage/' . $pengurus->image3) : null;
        $pengurus->image4_url = $pengurus->image4 ? url('storage/' . $pengurus->image4) : null;

        return response()->json([
            'status' => true,
            'message' => 'Detail pengurus berhasil diambil',
            'data' => $pengurus
        ], 200);
    }
}
