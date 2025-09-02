<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CategoryStore;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('category')->paginate(10);
        $categories = CategoryStore::all();

         if ($request->has('search') && !empty($request->search)) {
            $products->where('title', 'like', '%' . $request->search . '%');
        }

        return view('products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = CategoryStore::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|integer|min:0|max:100',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048', // max 2MB
            'disusun' => 'required|string|max:255',
            'jumlah_modul' => 'nullable|integer|min:1',
            'bahasa' => 'nullable|string|max:100',
            'notlp' => 'required|string|max:20',
            'category_store_id' => 'required|exists:store_categories,id',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = CategoryStore::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Validasi - image tidak required saat update
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|integer|min:0|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // nullable untuk update
            'disusun' => 'required|string|max:255',
            'jumlah_modul' => 'nullable|integer|min:1',
            'bahasa' => 'nullable|string|max:100',
            'notlp' => 'required|string|max:20',
            'category_store_id' => 'required|exists:store_categories,id',
        ]);

        // Handle image upload hanya jika ada file baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            // Upload gambar baru
            $data['image'] = $request->file('image')->store('products', 'public');
        } else {
            // Jika tidak ada file baru, hapus image dari array data agar tidak di-update
            unset($data['image']);
        }

        $product->update($data);
        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Hapus gambar jika ada
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
