<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Testimony;

class ApiTestimonyController extends Controller
{
    /**
     * Get all testimonies
     */
    public function index()
    {
        $testimonies = Testimony::with('category')->latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'Data testimony berhasil diambil',
            'data' => $testimonies
        ]);
    }

    /**
     * Get detail of a single testimony by ID
     */
    public function show($id)
    {
        $testimony = Testimony::with('category')->find($id);

        if (!$testimony) {
            return response()->json([
                'status' => false,
                'message' => 'Testimony tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Detail testimony berhasil diambil',
            'data' => $testimony
        ]);
    }
}
