<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function index()
    {
        $blog_posts = BlogPost::with('category')->get();
        return view('admin.blog_posts.index', compact('blog_posts'));
    }

    public function create()
    {
        $categories = BlogCategory::all();
        return view('admin.blog_posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'blog_category_id' => 'nullable|exists:blog_categories,id',
            'content' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'is_published' => 'nullable',
            'published_at' => 'nullable|date',
            'featured_image' => 'nullable|image|max:2048'
        ]);
        $data['slug'] = Str::slug($data['title']);
        $data['is_published'] = $request->has('is_published');
        
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('Blogs', 'public');
        }

        BlogPost::create($data);
        return redirect()->route('blog_posts.index')->with('success', 'Created successfully.');
    }

    public function edit(BlogPost $blogPost)
    {
        $categories = BlogCategory::all();
        return view('admin.blog_posts.edit', ['item' => $blogPost, 'categories' => $categories]);
    }

    public function update(Request $request, BlogPost $blogPost)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'blog_category_id' => 'nullable|exists:blog_categories,id',
            'content' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'is_published' => 'nullable',
            'published_at' => 'nullable|date',
            'featured_image' => 'nullable|image|max:2048'
        ]);
        $data['slug'] = Str::slug($data['title']);
        $data['is_published'] = $request->has('is_published');
        
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('Blogs', 'public');
        }

        $blogPost->update($data);
        return redirect()->route('blog_posts.index')->with('success', 'Updated successfully.');
    }

    public function destroy(BlogPost $blogPost)
    {
        $blogPost->delete();
        return redirect()->route('blog_posts.index')->with('success', 'Deleted successfully.');
    }
}
