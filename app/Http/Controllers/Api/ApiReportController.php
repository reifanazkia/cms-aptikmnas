<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiReportController extends Controller
{
    /**
     * GET: Ambil semua laporan
     */
    public function index()
    {
        $reports = Report::latest()->get();

        return response()->json([
            'status' => 'success',
            'data'   => $reports
        ], 200);
    }

    /**
     * GET: Ambil detail laporan by id
     */
    public function show($id)
    {
        $report = Report::find($id);

        if (!$report) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Laporan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $report
        ], 200);
    }

    /**
     * POST: Simpan laporan baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'masalah' => 'required|string',
            'pesan'   => 'required|string',
        ]);

        try {
            $report = Report::create($validated);

            return response()->json([
                'status'  => 'success',
                'message' => 'Laporan berhasil disimpan',
                'data'    => $report
            ], 201);
        } catch (\Exception $e) {
            Log::error('API Error simpan report: '.$e->getMessage());

            return response()->json([
                'status'  => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan laporan'
            ], 500);
        }
    }
}
