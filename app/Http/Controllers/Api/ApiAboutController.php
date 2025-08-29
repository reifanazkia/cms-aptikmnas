<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Aboutus;
use App\Models\CategoryAboutus;
use Illuminate\Support\Facades\Log;

class ApiAboutController extends Controller
{
    // GET semua data Tentangkami
    public function index()
    {
        try {
            $aboutus = Aboutus::with('category')
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $aboutus
            ]);
        } catch (\Exception $e) {
            Log::error('API Aboutus@index: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Gagal mengambil data'], 500);
        }
    }

    // GET aboutus berdasarkan category_id
    public function getByCategory($categoryId)
    {
        try {
            $aboutus = Aboutus::with('category')
                ->where('category_aboutus_id', $categoryId)
                ->latest()
                ->get();

            return response()->json(['success' => true, 'data' => $aboutus]);
        } catch (\Exception $e) {
            Log::error('API Aboutus@getByCategory: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Gagal mengambil data'], 500);
        }
    }

    // GET aboutus berdasarkan nama kategori
    public function getByCategoryName($categoryName)
    {
        try {
            $category = CategoryAboutus::where('name', $categoryName)->first();

            if (!$category) {
                return response()->json(['success' => false, 'message' => 'Kategori tidak ditemukan'], 404);
            }

            $aboutus = Aboutus::with('category')
                ->where('category_Aboutus_id', $category->id)
                ->latest()
                ->get();

            return response()->json(['success' => true, 'data' => $aboutus]);
        } catch (\Exception $e) {
            Log::error('API Aboutus@getByCategoryName: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Gagal mengambil data'], 500);
        }
    }

    // GET aboutus yang tampil di homepage
    public function getDisplayOnHome()
    {
        try {
            $aboutus = Aboutus::with('category')
                ->where('display_on_home', true)
                ->latest()
                ->get();

            return response()->json(['success' => true, 'data' => $aboutus]);
        } catch (\Exception $e) {
            Log::error('API Aboutus@getDisplayOnHome: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Gagal mengambil data'], 500);
        }
    }
}
