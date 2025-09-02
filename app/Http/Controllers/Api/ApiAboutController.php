<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class ApiAboutController extends Controller
{
    /**
     * Ambil semua data About (GET /api/about)
     */
    public function index()
    {
        $abouts = About::latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'Data About berhasil diambil',
            'data' => $abouts
        ], 200);
    }

    /**
     * Ambil detail data About berdasarkan ID (GET /api/about/{id})
     */
    public function show($id)
    {
        $about = About::find($id);

        if (!$about) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Detail About berhasil diambil',
            'data' => $about
        ], 200);
    }
}
