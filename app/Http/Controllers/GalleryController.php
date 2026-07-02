<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('sort_order')->get();
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'image_path' => 'required|image|max:2048',
            'group' => 'required|string|max:255',
            'sort_order' => 'nullable|integer'
        ]);

        $data['image_path'] = $request->file('image_path')->store('Media', 'public');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        Gallery::create($data);
        return redirect()->route('galleries.index')->with('success', 'Uploaded successfully.');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', ['item' => $gallery]);
    }

    public function update(Request $request, Gallery $gallery)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'image_path' => 'nullable|image|max:2048',
            'group' => 'required|string|max:255',
            'sort_order' => 'nullable|integer'
        ]);

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('Media', 'public');
        }

        $gallery->update($data);
        return redirect()->route('galleries.index')->with('success', 'Updated successfully.');
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return redirect()->route('galleries.index')->with('success', 'Deleted successfully.');
    }
}
