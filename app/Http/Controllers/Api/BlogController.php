<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Blog::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'blog_category_data' => 'required|exists:blog_categories,id',
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|file'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            // Store full URL with domain
            $validated['image'] = asset('storage/' . $path);
        }

        $blog = Blog::create($validated);

        return response()->json([
            'success' => true,
            'data' => $blog,
            'message' => 'Blog created successfully.'
        ], 201);
    }


    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        if ($blog->image) {
            $blog->image = asset('storage/' . $blog->image);
        }

        return response()->json([
            'success' => true,
            'data' => $blog
        ]);
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $validated = $request->validate([
            'blog_category_data' => 'sometimes|exists:blog_categories,id',
            'title' => 'sometimes|string',
            'description' => 'sometimes|string',
            'image' => 'nullable|file'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            $validated['image'] = asset('storage/' . $path); // Save full URL
        }

        $blog->update($validated);

        return response()->json([
            'success' => true,
            'data' => $blog,
            'message' => 'Blog updated successfully.'
        ]);
    }


    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return response()->json([
            'success' => true,
            'message' => 'Blog deleted successfully.'
        ]);
    }
}
