<?php

namespace App\Http\Controllers;

use App\Models\ActivityCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ActivityCategoryController extends Controller
{
    public function index()
    {
        $activity_categories = ActivityCategory::orderBy('sort_order')->get();
        return view('admin.activity_categories.index', compact('activity_categories'));
    }

    public function create()
    {
        return view('admin.activity_categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable',
            'sort_order' => 'nullable|integer'
        ]);

        $data['slug'] = Str::slug($data['name']);
        $data['status'] = $request->has('status');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        ActivityCategory::create($data);
        return redirect()->route('activity_categories.index')->with('success', 'Created successfully.');
    }

    public function edit(ActivityCategory $activityCategory)
    {
        return view('admin.activity_categories.edit', ['item' => $activityCategory]);
    }

    public function update(Request $request, ActivityCategory $activityCategory)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable',
            'sort_order' => 'nullable|integer'
        ]);

        $data['slug'] = Str::slug($data['name']);
        $data['status'] = $request->has('status');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $activityCategory->update($data);
        return redirect()->route('activity_categories.index')->with('success', 'Updated successfully.');
    }

    public function destroy(ActivityCategory $activityCategory)
    {
        $activityCategory->delete();
        return redirect()->route('activity_categories.index')->with('success', 'Deleted successfully.');
    }
}
