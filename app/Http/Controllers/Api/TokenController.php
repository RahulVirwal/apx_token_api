<?php

namespace App\Http\Controllers\Api;

use App\Models\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TokenController extends Controller
{
    public function index() { return Token::all(); }

    public function store(Request $request) {
        $validated = $request->validate(['price' => 'required|numeric']);
        return Token::create($validated);
    }

    public function show($id) { return Token::findOrFail($id); }

    public function update(Request $request, $id) {
        $token = Token::findOrFail($id);
        $validated = $request->validate(['price' => 'required|numeric']);
        $token->update($validated);
        return $token;
    }

    public function destroy($id) { return Token::destroy($id); }
}
