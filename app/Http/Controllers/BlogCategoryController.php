<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $blog_categories = BlogCategory::all();
        return view('admin.blog_categories.index', compact('blog_categories'));
    }

    public function create()
    {
        return view('admin.blog_categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $data['slug'] = Str::slug($data['name']);
        BlogCategory::create($data);
        return redirect()->route('blog_categories.index')->with('success', 'Created successfully.');
    }

    public function edit(BlogCategory $blogCategory)
    {
        return view('admin.blog_categories.edit', ['item' => $blogCategory]);
    }

    public function update(Request $request, BlogCategory $blogCategory)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $data['slug'] = Str::slug($data['name']);
        $blogCategory->update($data);
        return redirect()->route('blog_categories.index')->with('success', 'Updated successfully.');
    }

    public function destroy(BlogCategory $blogCategory)
    {
        $blogCategory->delete();
        return redirect()->route('blog_categories.index')->with('success', 'Deleted successfully.');
    }
}
