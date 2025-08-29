<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class ApiPartnerController extends Controller
{
    /**
     * Get all partners with optional search filter
     */
    public function index(Request $request)
    {
        $query = Partner::query();

        // Search by name
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $partners = $query->latest()->paginate(12);

        // Tambahkan full URL image
        $partners->getCollection()->transform(function ($item) {
            $item->image_url = $item->image ? url('storage/' . $item->image) : null;
            return $item;
        });

        return response()->json([
            'status' => true,
            'message' => 'Data partner berhasil diambil',
            'data' => $partners
        ], 200);
    }

    /**
     * Get single partner detail
     */
    public function show($id)
    {
        $partner = Partner::find($id);

        if (!$partner) {
            return response()->json([
                'status' => false,
                'message' => 'Partner tidak ditemukan'
            ], 404);
        }

        $partner->image_url = $partner->image ? url('storage/' . $partner->image) : null;

        return response()->json([
            'status' => true,
            'message' => 'Detail partner berhasil diambil',
            'data' => $partner
        ], 200);
    }
}
