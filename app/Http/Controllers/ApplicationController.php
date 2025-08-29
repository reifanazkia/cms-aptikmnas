<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $applications = Application::with('career:id,position_title')->latest()->paginate(10);
        $careers = Career::select('id', 'position_title')->get();

        if ($request->has('search') && !empty($request->search)) {
            $applications->where('nama', 'like', '%' . $request->search . '%');
        }

        return view('applications.index', compact('applications', 'careers'));
    }

    public function create()
    {
        $careers = Career::select('id', 'position_title')->get();
        return view('applications.create', compact('careers'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'career_id' => 'required|exists:careers,id',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_telepon' => 'required|string|max:20',
            'cover_letter' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['career_id', 'nama', 'email', 'no_telepon', 'cover_letter']);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('applications', $filename, 'public');
            $data['file'] = $path;
        }

        Application::create($data);

        return redirect()->route('applications.index')->with('success', 'Lamaran berhasil dikirim!');
    }

    public function edit($id)
    {
        $application = Application::findOrFail($id);
        $careers = Career::select('id', 'position_title')->get();
        return view('applications.edit', compact('application', 'careers'));
    }

    public function update(Request $request, $id)
    {
        $application = Application::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'career_id' => 'required|exists:careers,id',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_telepon' => 'required|string|max:20',
            'cover_letter' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['career_id', 'nama', 'email', 'no_telepon', 'cover_letter']);

        if ($request->hasFile('file')) {
            if ($application->file && Storage::disk('public')->exists($application->file)) {
                Storage::disk('public')->delete($application->file);
            }

            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('applications', $filename, 'public');
            $data['file'] = $path;
        }

        $application->update($data);

        return redirect()->route('applications.index')->with('success', 'Data lamaran berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $application = Application::findOrFail($id);

        if ($application->file && Storage::disk('public')->exists($application->file)) {
            Storage::disk('public')->delete($application->file);
        }

        $application->delete();

        return redirect()->route('applications.index')->with('success', 'Data lamaran berhasil dihapus!');
    }

    public function downloadFile($id)
    {
        $application = Application::findOrFail($id);

        if (!$application->file || !Storage::disk('public')->exists($application->file)) {
            abort(404, 'File tidak ditemukan');
        }

        $absolutePath = Storage::disk('public')->path($application->file);
        $storedName   = pathinfo($application->file, PATHINFO_BASENAME);
        $downloadName = preg_replace('/^\d+_/', '', $storedName);

        return response()->download($absolutePath, $downloadName);
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return redirect()->back()->with('error', 'Tidak ada data yang dipilih');
        }

        $applications = Application::whereIn('id', $ids)->get();

        foreach ($applications as $application) {
            if ($application->file && Storage::disk('public')->exists($application->file)) {
                Storage::disk('public')->delete($application->file);
            }
        }

        Application::whereIn('id', $ids)->delete();

        return redirect()->route('applications.index')->with('success', 'Data lamaran yang dipilih berhasil dihapus!');
    }
}
