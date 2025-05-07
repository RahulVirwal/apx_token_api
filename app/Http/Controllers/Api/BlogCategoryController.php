<?php

namespace App\Http\Controllers\Api;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogCategoryController extends Controller
{
    public function index() { return BlogCategory::all(); }

    public function store(Request $request) {
        $validated = $request->validate(['category_name' => 'required']);
        return BlogCategory::create($validated);
    }

    public function show($id) { return BlogCategory::findOrFail($id); }

    public function update(Request $request, $id) {
        $category = BlogCategory::findOrFail($id);
        $category->update($request->all());
        return $category;
    }

    public function destroy($id) { return BlogCategory::destroy($id); }
}
