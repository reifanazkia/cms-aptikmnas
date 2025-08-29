<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;

class ApiAgendaController extends Controller
{
    /**
     * Get all agendas with optional search & pagination
     */
    public function index(Request $request)
    {
        $query = Agenda::query();

        // Search by title if provided
        if ($request->has('search') && !empty($request->search)) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Paginate (default 10 per page)
        $agendas = $query->latest()->paginate(10);

        // Tambahkan full URL untuk gambar
        $agendas->getCollection()->transform(function ($item) {
            $item->image_url = $item->image ? url('agenda/' . $item->image) : null;
            return $item;
        });

        return response()->json([
            'status' => true,
            'message' => 'Data agenda berhasil diambil',
            'data' => $agendas
        ], 200);
    }

    /**
     * Get single agenda detail by ID
     */
    public function show($id)
    {
        $agenda = Agenda::find($id);

        if (!$agenda) {
            return response()->json([
                'status' => false,
                'message' => 'Agenda tidak ditemukan'
            ], 404);
        }

        // Tambahkan URL gambar
        $agenda->image_url = $agenda->image ? url('agenda/' . $agenda->image) : null;

        return response()->json([
            'status' => true,
            'message' => 'Detail agenda berhasil diambil',
            'data' => $agenda
        ], 200);
    }
}
