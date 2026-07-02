<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index(Request $request)
    {
        $query = Inquiry::orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $inquiries = $query->get();
        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function create()
    {
        return view('admin.inquiries.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company_name' => 'nullable|string|max:255',
            'message' => 'required|string',
            'status' => 'required|in:new,in_progress,resolved',
            'admin_notes' => 'nullable|string',
        ]);

        Inquiry::create($data);
        return redirect()->route('inquiries.index')->with('success', 'Created successfully.');
    }

    public function edit(Inquiry $inquiry)
    {
        return view('admin.inquiries.edit', ['item' => $inquiry]);
    }

    public function update(Request $request, Inquiry $inquiry)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company_name' => 'nullable|string|max:255',
            'message' => 'required|string',
            'status' => 'required|in:new,in_progress,resolved',
            'admin_notes' => 'nullable|string',
        ]);

        $inquiry->update($data);
        return redirect()->route('inquiries.index')->with('success', 'Updated successfully.');
    }

    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();
        return redirect()->route('inquiries.index')->with('success', 'Deleted successfully.');
    }
}
