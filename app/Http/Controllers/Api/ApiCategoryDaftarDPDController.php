<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CategoryDaftar;
use Illuminate\Http\Request;

class ApiCategoryDaftarDPDController extends Controller
{
    // GET semua kategori
    public function index()
    {
        $categories = CategoryDaftar::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'List kategori DPD',
            'data'    => $categories
        ], 200);
    }

    // GET detail kategori by ID
    public function show($id)
    {
        $category = CategoryDaftar::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $category
        ], 200);
    }

    // GET kategori by nama
    public function getByCategoryName($name)
    {
        $category = CategoryDaftar::where('name', $name)->first();

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $category
        ], 200);
    }
}
