<?php

namespace App\Http\Controllers;

use App\Models\CategoryDaftar;
use App\Models\CategoryPengurus;
use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PengurusController extends Controller
{
    public function index()
    {
        $pengurus = Pengurus::with(['categoryDaftar', 'categoryPengurus'])->paginate(10);
        return view('pengurus.index', compact('pengurus'));
    }

    public function show($id)
    {
        $pengurus = Pengurus::with(['categoryDaftar', 'categoryPengurus'])->findOrFail($id);
        return view('pengurus.show', compact('pengurus'));
    }

    // CREATE METHODS
    public function create()
    {
        $categoryDaftar = CategoryDaftar::all();
        $categoryPengurus = CategoryPengurus::all();

        return view('pengurus.create.step1', compact('categoryDaftar', 'categoryPengurus'));
    }

    public function storeStep1(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'descroption' => 'required|string|max:255', // Fix typo: should be 'description'
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fb' => 'nullable|string|max:255',
            'ig' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'yt' => 'nullable|string|max:255',
            'category_daftar_id' => 'nullable|exists:daftar_dpd_categories,id',
            'category_pengurus_id' => 'nullable|exists:pengurus_categories,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput();
        }

        $data = $request->except('image');

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('pengurus', 'public');
            $data['image'] = $imagePath;
        }

        // Add step completion marker
        $data['step1_completed'] = true; // Add this field to track completion

        // Create pengurus record
        $pengurus = Pengurus::create($data);

        return redirect()->route('pengurus.create.step2', $pengurus->id)
                        ->with('success', 'Step 1 berhasil disimpan!');
    }

    public function createStep2($id)
    {
        $pengurus = Pengurus::findOrFail($id);

        // Simplified validation - just check if step1 data exists and is completed
        if (!$this->isStep1Valid($pengurus)) {
            return redirect()->route('pengurus.create')
                           ->with('error', 'Silakan selesaikan Step 1 terlebih dahulu!');
        }

        return view('pengurus.create.step2', compact('pengurus'));
    }

    public function storeStep2(Request $request, $id)
    {
        $pengurus = Pengurus::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title2' => 'required|string|max:255',
            'title3' => 'required|string|max:255',
            'description2' => 'required|string',
            'description3' => 'required|string',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput();
        }

        $data = $request->except(['image2', 'image3']);

        // Handle image2 upload
        if ($request->hasFile('image2')) {
            $image2Path = $request->file('image2')->store('pengurus', 'public');
            $data['image2'] = $image2Path;
        }

        // Handle image3 upload
        if ($request->hasFile('image3')) {
            $image3Path = $request->file('image3')->store('pengurus', 'public');
            $data['image3'] = $image3Path;
        }

        // Add step completion marker
        $data['step2_completed'] = true;

        $pengurus->update($data);

        return redirect()->route('pengurus.create.step3', $pengurus->id)
                        ->with('success', 'Step 2 berhasil disimpan!');
    }

    public function createStep3($id)
    {
        $pengurus = Pengurus::findOrFail($id);

        if (!$this->isStep1Valid($pengurus) || !$this->isStep2Valid($pengurus)) {
            return redirect()->route('pengurus.create')
                           ->with('error', 'Silakan selesaikan step sebelumnya terlebih dahulu!');
        }

        return view('pengurus.create.step3', compact('pengurus'));
    }

    public function storeStep3(Request $request, $id)
    {
        $pengurus = Pengurus::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title4' => 'required|string|max:255',
            'description4' => 'required|string',
            'image4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput();
        }

        $data = $request->except('image4');

        // Handle image4 upload
        if ($request->hasFile('image4')) {
            $image4Path = $request->file('image4')->store('pengurus', 'public');
            $data['image4'] = $image4Path;
        }

        // Mark as fully completed
        $data['step3_completed'] = true;
        $data['completed'] = true;

        $pengurus->update($data);

        return redirect()->route('pengurus.index')
                        ->with('success', 'Data pengurus berhasil dibuat lengkap!');
    }

    // EDIT METHODS (unchanged but updated validation methods)
    public function edit($id)
    {
        $pengurus = Pengurus::findOrFail($id);
        $categoryDaftar = CategoryDaftar::all();
        $categoryPengurus = CategoryPengurus::all();

        return view('pengurus.edit.step1', compact('pengurus', 'categoryDaftar', 'categoryPengurus'));
    }

    public function updateStep1(Request $request, $id)
    {
        $pengurus = Pengurus::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'descroption' => 'required|string|max:255', // Fix typo in your database
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fb' => 'nullable|string|max:255',
            'ig' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'yt' => 'nullable|string|max:255',
            'category_daftar_id' => 'nullable|exists:daftar_dpd_categories,id',
            'category_pengurus_id' => 'nullable|exists:pengurus_categories,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput();
        }

        $data = $request->except('image');

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($pengurus->image) {
                Storage::disk('public')->delete($pengurus->image);
            }
            $imagePath = $request->file('image')->store('pengurus', 'public');
            $data['image'] = $imagePath;
        }

        $pengurus->update($data);

        return redirect()->route('pengurus.edit.step2', $pengurus->id)
                        ->with('success', 'Step 1 berhasil diupdate!');
    }

    public function editStep2($id)
    {
        $pengurus = Pengurus::findOrFail($id);
        return view('pengurus.edit.step2', compact('pengurus'));
    }

    public function updateStep2(Request $request, $id)
    {
        $pengurus = Pengurus::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title2' => 'required|string|max:255',
            'title3' => 'required|string|max:255',
            'description2' => 'required|string',
            'description3' => 'required|string',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput();
        }

        $data = $request->except(['image2', 'image3']);

        // Handle image2 upload
        if ($request->hasFile('image2')) {
            if ($pengurus->image2) {
                Storage::disk('public')->delete($pengurus->image2);
            }
            $image2Path = $request->file('image2')->store('pengurus', 'public');
            $data['image2'] = $image2Path;
        }

        // Handle image3 upload
        if ($request->hasFile('image3')) {
            if ($pengurus->image3) {
                Storage::disk('public')->delete($pengurus->image3);
            }
            $image3Path = $request->file('image3')->store('pengurus', 'public');
            $data['image3'] = $image3Path;
        }

        $pengurus->update($data);

        return redirect()->route('pengurus.edit.step3', $pengurus->id)
                        ->with('success', 'Step 2 berhasil diupdate!');
    }

    public function editStep3($id)
    {
        $pengurus = Pengurus::findOrFail($id);
        return view('pengurus.edit.step3', compact('pengurus'));
    }

    public function updateStep3(Request $request, $id)
    {
        $pengurus = Pengurus::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title4' => 'required|string|max:255',
            'description4' => 'required|string',
            'image4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput();
        }

        $data = $request->except('image4');

        // Handle image4 upload
        if ($request->hasFile('image4')) {
            if ($pengurus->image4) {
                Storage::disk('public')->delete($pengurus->image4);
            }
            $image4Path = $request->file('image4')->store('pengurus', 'public');
            $data['image4'] = $image4Path;
        }

        $pengurus->update($data);

        return redirect()->route('pengurus.index')
                        ->with('success', 'Data pengurus berhasil diupdate lengkap!');
    }

    public function destroy($id)
    {
        $pengurus = Pengurus::findOrFail($id);

        // Delete associated images
        if ($pengurus->image) {
            Storage::disk('public')->delete($pengurus->image);
        }
        if ($pengurus->image2) {
            Storage::disk('public')->delete($pengurus->image2);
        }
        if ($pengurus->image3) {
            Storage::disk('public')->delete($pengurus->image3);
        }
        if ($pengurus->image4) {
            Storage::disk('public')->delete($pengurus->image4);
        }

        $pengurus->delete();

        return redirect()->route('pengurus.index')
                        ->with('success', 'Data pengurus berhasil dihapus!');
    }

    // PRIVATE HELPER METHODS
    private function isStep1Valid($pengurus)
    {
        // Check only required fields from step 1
        return !empty($pengurus->title) &&
               !empty($pengurus->descroption) && // Fix typo in your database
               !empty($pengurus->address) &&
               !empty($pengurus->phone) &&
               !empty($pengurus->email);
    }

    private function isStep2Valid($pengurus)
    {
        // Check only required fields from step 2
        return !empty($pengurus->title2) &&
               !empty($pengurus->title3) &&
               !empty($pengurus->description2) &&
               !empty($pengurus->description3);
    }

    private function isStep3Valid($pengurus)
    {
        // Check only required fields from step 3
        return !empty($pengurus->title4) &&
               !empty($pengurus->description4);
    }
}
