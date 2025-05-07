<?php

namespace App\Http\Controllers\Api;

use App\Models\Ad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdController extends Controller
{
    public function index() { return Ad::all(); }

    public function store(Request $request) {
        $validated = $request->validate([
            'type' => 'required',
            'title' => 'required',
            'sub_title' => 'nullable',
            'file' => 'nullable|file'
        ]);
        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('uploads');
        }
        return Ad::create($validated);
    }

    public function show($id) { return Ad::findOrFail($id); }

    public function update(Request $request, $id) {
        $ad = Ad::findOrFail($id);
        $validated = $request->validate([
            'type' => 'sometimes',
            'title' => 'sometimes',
            'sub_title' => 'sometimes',
            'file' => 'nullable|file'
        ]);
        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('uploads');
        }
        $ad->update($validated);
        return $ad;
    }

    public function destroy($id) { return Ad::destroy($id); }
}
