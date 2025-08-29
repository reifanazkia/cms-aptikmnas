<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;

class ApiCareerController extends Controller
{
    /**
     * Get all careers with optional search
     */
    public function index(Request $request)
    {
        $query = Career::query();

        // Filter by search on position_title
        if ($request->has('search') && !empty($request->search)) {
            $query->where('position_title', 'like', '%' . $request->search . '%');
        }

        $careers = $query->latest()->paginate(10);

        return response()->json([
            'status' => true,
            'message' => 'Data career berhasil diambil',
            'data' => $careers
        ], 200);
    }

    /**
     * Get career detail with applicants (applications)
     */
    public function show($id)
    {
        $career = Career::with(['applications' => function ($q) {
            $q->latest()->paginate(10);
        }])->find($id);

        if (!$career) {
            return response()->json([
                'status' => false,
                'message' => 'Career tidak ditemukan'
            ], 404);
        }

        // Ambil daftar pelamar dengan pagination terpisah
        $applicants = $career->applications()->latest()->paginate(10);

        // Tambahkan file_url di setiap pelamar
        $applicants->getCollection()->transform(function ($item) {
            $item->file_url = $item->file ? url('storage/' . $item->file) : null;
            return $item;
        });

        return response()->json([
            'status' => true,
            'message' => 'Detail career berhasil diambil',
            'data' => [
                'career' => $career,
                'applicants' => $applicants
            ]
        ], 200);
    }
}
