<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ApiContactController extends Controller
{
    public function index()
    {
        $contact = Contact::latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'Contact berhasil di ambil',
            'data' => $contact
        ], 200);
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);

        if (!$contact) {
            return response()->json([
                'status' => false,
                'message' => 'Detail contact tidak di temukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Contact berhasil di ambil',
            'data' => $contact

        ]);
    }
}
