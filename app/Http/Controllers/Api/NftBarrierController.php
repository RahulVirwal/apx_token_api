<?php

namespace App\Http\Controllers\Api;

use App\Models\NftBarrier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NftBarrierController extends Controller
{
    public function index() { return NftBarrier::all(); }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|file'
        ]);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('uploads');
        }
        return NftBarrier::create($validated);
    }

    public function show($id) { return NftBarrier::findOrFail($id); }

    public function update(Request $request, $id) {
        $barrier = NftBarrier::findOrFail($id);
        $validated = $request->validate([
            'name' => 'sometimes',
            'description' => 'sometimes',
            'image' => 'nullable|file'
        ]);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('uploads');
        }
        $barrier->update($validated);
        return $barrier;
    }

    public function destroy($id) { return NftBarrier::destroy($id); }
}
