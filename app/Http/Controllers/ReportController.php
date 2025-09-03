<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\Return_;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $report = Report::latest()->paginate(10);
        return view('report.index', compact('report'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('report.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'masalah' => 'required|string',
            'pesan' => 'required|string',
        ]);

        try {
            Report::create($validate);
            return redirect()->route('report.index')->with('success', 'Data berhasil di tambahkan');
        } catch (\Exception $e) {
            Log::error('Error menyimpan data report: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data report');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $report = Report::findOrFail($id);
        return view('report.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $report = Report::findOrFail($id);
        return view('report.edit', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'masalah' => 'required|string',
            'pesan' => 'required|string',
        ]);


        try {
            $report = Report::findOrFail($id);
            $report->update($validate);

            return redirect()->route('report.index')->with('success', 'Data Berhasil Di Ubah');
        } catch (\Exception $e) {
            Log::error('Error update report: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $report = Report::findOrFail($id);
            $report->delete();

            return redirect()->route('report.index')->with('success', 'Laporan Berhasil di hapus');
        } catch (\Exception $e) {
            Log::error('Error delete report: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menghapus laporan.');
        }
    }
}
