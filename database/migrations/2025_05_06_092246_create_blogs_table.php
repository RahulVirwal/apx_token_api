<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return response()->json([
            'status' => 'success',
            'data' => $blogs
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
            $validated['image'] = $request->file('image')->store('uploads');
        }

        $blog = Blog::create([
            'blog_category_id' => $validated['blog_category_data'], // Assuming your blog has this field
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image' => $validated['image'] ?? null,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $blog
        ], 201);
    }

    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $blog
        ]);
    }

    public function update(Request $request, $id)
    {
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

        $blog->update([
            'blog_category_id' => $validated['blog_category_data'] ?? $blog->blog_category_id,
            'title' => $validated['title'] ?? $blog->title,
            'description' => $validated['description'] ?? $blog->description,
            'image' => $validated['image'] ?? $blog->image,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $blog
        ]);
    }

    public function destroy($id)
    {
        if (Blog::destroy($id)) {
            return response()->json([
                'status' => 'success',
                'message' => 'Blog deleted successfully'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Blog not found'
            ], 404);
        }
    }
}
