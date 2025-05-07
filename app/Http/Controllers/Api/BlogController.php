<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index() { return Blog::all(); }

    public function store(Request $request) {
        $validated = $request->validate([
            'blog_category_data' => 'required|exists:blog_categories,id',
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|file'
        ]);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('uploads');
        }
        return Blog::create($validated);
    }

    public function show($id) { return Blog::findOrFail($id); }

    public function update(Request $request, $id) {
        $blog = Blog::findOrFail($id);
        $validated = $request->validate([
            'blog_category_data' => 'sometimes|exists:blog_categories,id',
            'title' => 'sometimes',
            'description' => 'sometimes',
            'image' => 'nullable|file'
        ]);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('uploads');
        }
        $blog->update($validated);
        return $blog;
    }

    public function destroy($id) { return Blog::destroy($id); }
}
