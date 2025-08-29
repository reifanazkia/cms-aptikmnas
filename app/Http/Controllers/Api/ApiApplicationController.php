<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiApplicationController extends Controller
{
    /**
     * Get all applications with optional search & filter
     */
    public function index(Request $request)
    {
        $query = Application::with('career:id,position_title');

        // Filter by search (nama)
        if ($request->has('search') && !empty($request->search)) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // Filter by career_id
        if ($request->has('career_id') && !empty($request->career_id)) {
            $query->where('career_id', $request->career_id);
        }

        // Paginate (default 10 per page)
        $applications = $query->latest()->paginate(10);

        // Tambahkan full URL untuk file
        $applications->getCollection()->transform(function ($item) {
            $item->file_url = $item->file ? url('storage/' . $item->file) : null;
            return $item;
        });

        return response()->json([
            'status' => true,
            'message' => 'Data lamaran berhasil diambil',
            'data' => $applications
        ], 200);
    }

    /**
     * Get single application detail by ID
     */
    public function show($id)
    {
        $application = Application::with('career:id,position_title')->find($id);

        if (!$application) {
            return response()->json([
                'status' => false,
                'message' => 'Data lamaran tidak ditemukan'
            ], 404);
        }

        // Tambahkan full URL untuk file
        $application->file_url = $application->file ? url('storage/' . $application->file) : null;

        return response()->json([
            'status' => true,
            'message' => 'Detail lamaran berhasil diambil',
            'data' => $application
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'career_id' => 'required|exists:careers,id',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_telepon' => 'required|string|max:20',
            'cover_letter' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf|max:2048', // Max 2MB
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->only(['career_id', 'nama', 'email', 'no_telepon', 'cover_letter']);

        // Upload file jika ada
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('applications', $filename, 'public');
            $data['file'] = $path;
        }

        $application = Application::create($data);
        $application->load('career:id,position_title');

        return response()->json([
            'status' => true,
            'message' => 'Lamaran berhasil dikirim!',
            'data' => $application
        ]);
    }
}
