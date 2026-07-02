<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::with('category')->get();
        return view('admin.activities.index', compact('activities'));
    }

    public function create()
    {
        $categories = ActivityCategory::all();
        return view('admin.activities.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'activity_category_id' => 'nullable|exists:activity_categories,id',
            'short_description' => 'nullable|string',
            'detailed_description' => 'nullable|string',
            'objectives' => 'nullable|string',
            'expected_impact' => 'nullable|string',
            'duration' => 'nullable|string',
            'location' => 'nullable|string',
            'beneficiary_information' => 'nullable|string',
            'status' => 'required|in:draft,published,archived',
            'cover_image' => 'nullable|image|max:2048',
            'pdf_brochure' => 'nullable|file|mimes:pdf|max:5120',
        ]);
        
        $data['slug'] = Str::slug($data['name']);
        
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('Activities/Images', 'public');
        }
        
        if ($request->hasFile('pdf_brochure')) {
            $data['pdf_brochure'] = $request->file('pdf_brochure')->store('Activities/Brochures', 'public');
        }

        Activity::create($data);
        return redirect()->route('activities.index')->with('success', 'Created successfully.');
    }

    public function edit(Activity $activity)
    {
        $categories = ActivityCategory::all();
        return view('admin.activities.edit', ['item' => $activity, 'categories' => $categories]);
    }

    public function update(Request $request, Activity $activity)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'activity_category_id' => 'nullable|exists:activity_categories,id',
            'short_description' => 'nullable|string',
            'detailed_description' => 'nullable|string',
            'objectives' => 'nullable|string',
            'expected_impact' => 'nullable|string',
            'duration' => 'nullable|string',
            'location' => 'nullable|string',
            'beneficiary_information' => 'nullable|string',
            'status' => 'required|in:draft,published,archived',
            'cover_image' => 'nullable|image|max:2048',
            'pdf_brochure' => 'nullable|file|mimes:pdf|max:5120',
        ]);
        
        $data['slug'] = Str::slug($data['name']);
        
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('Activities/Images', 'public');
        }
        
        if ($request->hasFile('pdf_brochure')) {
            $data['pdf_brochure'] = $request->file('pdf_brochure')->store('Activities/Brochures', 'public');
        }

        $activity->update($data);
        return redirect()->route('activities.index')->with('success', 'Updated successfully.');
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();
        return redirect()->route('activities.index')->with('success', 'Deleted successfully.');
    }
}
