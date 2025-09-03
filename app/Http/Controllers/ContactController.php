<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::when(request('search'), function ($query) {
            $query->where('email_dpp', 'like', '%' . request('search') . '%')
                ->orWhere('email_dpd', 'like', '%' . request('search') . '%')
                ->orWhere('alamat', 'like', '%' . request('search') . '%')
                ->orWhere('notlp', 'like', '%' . request('search') . '%');
        })->paginate(10);

        return view('contact.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email_dpp' => 'required|email|max:255',
            'email_dpd' => 'required|email|max:255',
            'alamat' => 'required|string',
            'notlp' => ['required', 'regex:/^[0-9+\-\s()]+$/'],
            'url_ig' => 'nullable|url',
            'url_fb' => 'nullable|url',
            'url_yt' => 'nullable|url',
            'url_in' => 'nullable|url',
            'url_twit' => 'nullable|url',
            'url_tiktok' => 'nullable|url',
            'start_datetime' => 'nullable|date',
            'end_datetime'   => 'nullable|date|after_or_equal:start_datetime',
        ]);

        Contact::create($request->all());

        return redirect()->route('contact.index')->with('success', 'Contact created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contact.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'email_dpp' => 'required|email|max:255',
            'email_dpd' => 'required|email|max:255',
            'alamat' => 'required|string',
            'notlp' => ['required', 'regex:/^[0-9+\-\s()]+$/'],
            'url_ig' => 'nullable|url',
            'url_fb' => 'nullable|url',
            'url_yt' => 'nullable|url',
            'url_in' => 'nullable|url',
            'url_twit' => 'nullable|url',
            'url_tiktok' => 'nullable|url',
            'start_datetime' => 'required|date',
            'end_datetime'   => 'nullable|date|after_or_equal:start_datetime',
        ]);

        $contact = Contact::findOrFail($id);
        $contact->update($request->all());

        return redirect()->route('contact.index')->with('success', 'Contact updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('contact.index')->with('success', 'Contact deleted successfully.');
    }
}
