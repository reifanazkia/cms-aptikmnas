<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $agendas = Agenda::latest()->get();

         if ($request->has('search') && !empty($request->search)) {
            $agendas->where('title', 'like', '%' . $request->search . '%');
        }

        return view('agenda.index', compact('agendas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('agenda.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'required|string',
            'start_datetime' => 'required|date',
            'end_datetime'   => 'nullable|date|after_or_equal:start_datetime',
            'event_organizer'=> 'nullable|string|max:255',
            'location'       => 'required|string|max:255',
            'youtube_link'   => 'nullable|url',
            'type'           => 'nullable|string|max:100',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '-' . Str::slug($request->title) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('agenda'), $imageName);
        }

        Agenda::create([
            'title'          => $request->title,
            'description'    => $request->description,
            'start_datetime' => $request->start_datetime,
            'end_datetime'   => $request->end_datetime,
            'event_organizer'=> $request->event_organizer,
            'location'       => $request->location,
            'youtube_link'   => $request->youtube_link,
            'type'           => $request->type,
            'image'          => $imageName
        ]);

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agenda $agenda)
    {
        return view('agenda.edit', compact('agenda'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agenda $agenda)
    {
        $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'required|string',
            'start_datetime' => 'required|date',
            'end_datetime'   => 'nullable|date|after_or_equal:start_datetime',
            'event_organizer'=> 'nullable|string|max:255',
            'location'       => 'required|string|max:255',
            'youtube_link'   => 'nullable|url',
            'type'           => 'nullable|string|max:100',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $imageName = $agenda->image;
        if ($request->hasFile('image')) {
            if ($agenda->image && file_exists(public_path('agenda/' . $agenda->image))) {
                unlink(public_path('agenda/' . $agenda->image));
            }
            $imageName = time() . '-' . Str::slug($request->title) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('agenda'), $imageName);
        }

        $agenda->update([
            'title'          => $request->title,
            'description'    => $request->description,
            'start_datetime' => $request->start_datetime,
            'end_datetime'   => $request->end_datetime,
            'event_organizer'=> $request->event_organizer,
            'location'       => $request->location,
            'youtube_link'   => $request->youtube_link,
            'type'           => $request->type,
            'image'          => $imageName
        ]);

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agenda $agenda)
    {
        if ($agenda->image && file_exists(public_path('agenda/' . $agenda->image))) {
            unlink(public_path('agenda/' . $agenda->image));
        }

        $agenda->delete();

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil dihapus!');
    }
}
