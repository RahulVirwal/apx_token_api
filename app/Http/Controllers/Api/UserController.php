<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index() { return User::all(); }

    public function store(Request $request) {
        $validated = $request->validate([
            'user_id' => 'required|unique:users,user_id',
            'device_token' => 'required',
            'name' => 'required',
            'mobile_no' => 'required',
            'email' => 'required|email|unique:users,email',
            'aadhar_card_no' => 'required',
            'pan_card_no' => 'required',
            'image' => 'nullable|file'
        ]);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('uploads');
        }
        return User::create($validated);
    }

    public function show($id) { return User::findOrFail($id); }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'user_id' => 'sometimes',
            'device_token' => 'sometimes',
            'name' => 'sometimes',
            'mobile_no' => 'sometimes',
            'email' => 'sometimes|email',
            'aadhar_card_no' => 'sometimes',
            'pan_card_no' => 'sometimes',
            'image' => 'nullable|file'
        ]);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('uploads');
        }
        $user->update($validated);
        return $user;
    }

    public function destroy($id) { return User::destroy($id); }
}
