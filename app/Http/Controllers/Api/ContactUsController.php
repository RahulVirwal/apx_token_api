<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the contact messages.
     */
    public function index()
    {
        return response()->json(ContactUs::latest()->get());
    }

    /**
     * Store a newly created contact message in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'country' => 'required|string|max:100',
            'phone_no' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        $contact = ContactUs::create($validated);

        return response()->json([
            'message' => 'Contact message submitted successfully.',
            'data' => $contact
        ], 201);
    }

    /**
     * Display the specified contact message.
     */
    public function show(string $id)
    {
        $contact = ContactUs::findOrFail($id);
        return response()->json($contact);
    }

    /**
     * Update the specified contact message.
     */
    public function update(Request $request, string $id)
    {
        $contact = ContactUs::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|max:255',
            'country' => 'sometimes|required|string|max:100',
            'phone_no' => 'sometimes|required|string|max:20',
            'message' => 'sometimes|required|string',
        ]);

        $contact->update($validated);

        return response()->json([
            'message' => 'Contact message updated.',
            'data' => $contact
        ]);
    }

    /**
     * Remove the specified contact message from storage.
     */
    public function destroy(string $id)
    {
        $contact = ContactUs::findOrFail($id);
        $contact->delete();

        return response()->json(['message' => 'Contact message deleted.']);
    }
}
