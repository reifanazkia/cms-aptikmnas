<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Podcast;
use Illuminate\Http\Request;

class ApiPodcastsController extends Controller
{
    /**
     * Ambil semua podcast
     */
    public function index()
    {
        $podcasts = Podcast::with('category')->latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'Daftar podcast berhasil diambil',
            'data' => $podcasts
        ]);
    }

    /**
     * Ambil detail podcast berdasarkan id
     */
    public function show($id)
    {
        $podcast = Podcast::with('category')->find($id);

        if (!$podcast) {
            return response()->json([
                'status' => false,
                'message' => 'Podcast tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Detail podcast berhasil diambil',
            'data' => $podcast
        ]);
    }
}
