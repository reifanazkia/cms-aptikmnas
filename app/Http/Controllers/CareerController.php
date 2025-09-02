<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index(Request $request)
    {
        $query = Career::latest();

        if ($request->has('search') && !empty($request->search)) {
            $query->where('position_title', 'like', '%' . $request->search . '%');
        }

        $careers = $query->paginate(10); // <-- gunakan paginate
        return view('career.index', compact('careers'));
    }


    public function create()
    {
        return view('career.create');
    }

    // Method untuk menampilkan detail pekerjaan dan pelamar
    public function show($id)
    {
        $career = Career::with('applications')->findOrFail($id);
        $applicants = $career->applications()->latest()->paginate(10); // Pagination
        return view('career.show', compact('career', 'applicants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'position_title' => 'required|string',
            'job_type' => 'required|string',
            'lokasi' => 'required|string',
            'ringkasan' => 'required|string',
            'pengalaman' => 'required|string',
            'jam_kerja' => 'required|string',
            'hari_kerja' => 'required|string',
            'klasifikasi' => 'required|array',
            'klasifikasi.*' => 'required|string',
            'deskripsi' => 'required|array',
            'deskripsi.*' => 'required|string',
        ]);

        $career = new Career();
        $career->job_type = $request->job_type;
        $career->position_title = $request->position_title;
        $career->lokasi = $request->lokasi;
        $career->pengalaman = $request->pengalaman;
        $career->jam_kerja = $request->jam_kerja;
        $career->hari_kerja = $request->hari_kerja;
        $career->ringkasan = $request->ringkasan;
        $career->klasifikasi = $request->klasifikasi;
        $career->deskripsi = $request->deskripsi;
        $career->save();

        return redirect()->route('career.index')->with('success', 'Career created successfully.');
    }

    public function edit($id)
    {
        $career = Career::findOrFail($id);
        return view('career.edit', compact('career'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'job_type' => 'required|string',
            'position_title' => 'required|string',
            'lokasi' => 'required|string',
            'pengalaman' => 'required|string',
            'jam_kerja' => 'required|string',
            'hari_kerja' => 'required|string',
            'ringkasan' => 'required|string',
            'klasifikasi' => 'required|array',
            'klasifikasi.*' => 'required|string',
            'deskripsi' => 'required|array',
            'deskripsi.*' => 'required|string',
        ]);

        $career = Career::findOrFail($id);
        $career->job_type = $request->job_type;
        $career->position_title = $request->position_title;
        $career->lokasi = $request->lokasi;
        $career->pengalaman = $request->pengalaman;
        $career->jam_kerja = $request->jam_kerja;
        $career->hari_kerja = $request->hari_kerja;
        $career->ringkasan = $request->ringkasan;
        $career->klasifikasi = $request->klasifikasi;
        $career->deskripsi = $request->deskripsi;
        $career->save();

        return redirect()->route('career.index')->with('success', 'Career updated successfully.');
    }

    public function destroy($id)
    {
        $career = Career::findOrFail($id);
        $career->delete();
        return redirect()->route('career.index')->with('success', 'Career deleted successfully.');
    }
}

