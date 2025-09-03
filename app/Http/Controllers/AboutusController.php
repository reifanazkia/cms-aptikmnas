<?php

namespace App\Http\Controllers;

use App\Models\Aboutus;
use App\Models\CategoryAboutus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class AboutusController extends Controller
{
    public function index()
    {
        try {
            $totalRecords = Aboutus::count();
            Log::info('Total Aboutus records in database: ' . $totalRecords);

            $aboutus = Aboutus::with(['category'])->orderBy('created_at', 'desc')->get();

            $categories = CategoryAboutus::orderBy('name')->get();

            return view('aboutus.index', compact('aboutus', 'categories'));
        } catch (\Exception $e) {
            Log::error('Error in AboutusController@index: ' . $e->getMessage());
            return view('aboutus.index', ['aboutus' => collect(), 'categories' => collect()])
                ->with('error', 'Terjadi kesalahan saat memuat data.');
        }
    }

    public function create()
    {
        try {
            $categories = CategoryAboutus::orderBy('name')->get();
            return view('aboutus.create', compact('categories'));
        } catch (\Exception $e) {
            Log::error('Error in AboutusController@create: ' . $e->getMessage());
            return redirect()->route('aboutus.index')->with('error', 'Gagal memuat form tambah data.');
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'category_aboutus_id' => 'required|exists:aboutus_categories,id',
                'description' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'display_on_home' => 'sometimes|boolean',
            ]);

            $categoryExists = CategoryAboutus::find($request->category_aboutus_id);
            if (!$categoryExists) {
                return redirect()->back()
                    ->with('error', 'Kategori yang dipilih tidak valid.')
                    ->withInput();
            }

            $imagePath = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                if ($file->isValid()) {
                    $path = $file->store('aboutus', 'public');
                    $imagePath = 'storage/' . $path;
                }
            }

            $dataToStore = [
                'title' => $request->title,
                'category_aboutus_id' => $request->category_aboutus_id,
                'description' => $request->description,
                'image' => $imagePath,
                'display_on_home' => $request->has('display_on_home') ? 1 : 0,
            ];

            Aboutus::create($dataToStore);

            return redirect()->route('aboutus.index')->with('success', 'Data berhasil ditambahkan.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error in AboutusController@store: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.')->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $aboutus = Aboutus::findOrFail($id);
            $categories = CategoryAboutus::orderBy('name')->get();
            return view('aboutus.edit', compact('aboutus', 'categories'));
        } catch (\Exception $e) {
            Log::error('Error in AboutusController@edit: ' . $e->getMessage());
            return redirect()->route('aboutus.index')->with('error', 'Gagal memuat form edit data.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $aboutus = Aboutus::findOrFail($id);

            $request->validate([
                'title' => 'required|string|max:255',
                'category_aboutus_id' => 'required|exists:aboutus_categories,id',
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'display_on_home' => 'sometimes|boolean',
            ]);

            $updateData = [
                'title' => $request->title,
                'category_aboutus_id' => $request->category_aboutus_id,
                'description' => $request->description,
                'display_on_home' => $request->has('display_on_home') ? 1 : 0,
            ];

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                if ($file->isValid()) {
                    if ($aboutus->image && File::exists(public_path($aboutus->image))) {
                        File::delete(public_path($aboutus->image));
                    }
                    $path = $file->store('aboutus', 'public');
                    $updateData['image'] = 'storage/' . $path;
                }
            }

            $aboutus->update($updateData);

            return redirect()->route('aboutus.index')->with('success', 'Data berhasil diperbarui.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error in AboutusController@update: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data.')->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $aboutus = Aboutus::findOrFail($id);

            if ($aboutus->image && File::exists(public_path($aboutus->image))) {
                File::delete(public_path($aboutus->image));
            }

            $aboutus->delete();

            return redirect()->route('aboutus.index')->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error in AboutusController@destroy: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }

    // API Methods
    public function getByCategory($categoryId)
    {
        try {
            $aboutus = Aboutus::with('category')
                ->where('category_aboutus_id', $categoryId)
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $aboutus
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan'], 500);
        }
    }

    public function getByCategoryName($categoryName)
    {
        try {
            $category = CategoryAboutus::where('name', $categoryName)->first();

            if (!$category) {
                return response()->json(['success' => false, 'message' => 'Category not found'], 404);
            }

            $aboutus = Aboutus::with('category')
                ->where('category_aboutus_id', $category->id)
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json(['success' => true, 'data' => $aboutus]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan'], 500);
        }
    }

    public function getDisplayOnHome()
    {
        try {
            $aboutus = Aboutus::with('category')
                ->where('display_on_home', 1)
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json(['success' => true, 'data' => $aboutus]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan'], 500);
        }
    }
}
