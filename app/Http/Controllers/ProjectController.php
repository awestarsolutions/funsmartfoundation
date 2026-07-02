<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Activity;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProjectAssignedMail;
use App\Mail\ReportUploadedMail;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with(['activity', 'company']);

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('company_id')) {
            $query->where('company_id', $request->input('company_id'));
        }

        $projects = $query->get();
        $companies = Company::all();
        return view('admin.projects.index', compact('projects', 'companies'));
    }

    public function create()
    {
        $activities = Activity::all();
        $companies = Company::all();
        return view('admin.projects.create', compact('activities', 'companies'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'activity_id' => 'required|exists:activities,id',
            'company_id' => 'required|exists:companies,id',
            'status' => 'required|in:upcoming,active,completed',
            'execution_date' => 'nullable|date',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
            'budget' => 'nullable|numeric',
            'coordinator_name' => 'nullable|string|max:255',
            'coordinator_phone' => 'nullable|string|max:50',
            'admin_notes' => 'nullable|string',
            'report_file' => 'nullable|file|mimes:pdf|max:20480',
            'photo_files' => 'nullable|array',
            'photo_files.*' => 'image|max:10240',
        ]);

        if ($request->hasFile('report_file')) {
            $data['report_path'] = $request->file('report_file')->store('reports', 'public');
        }

        if ($request->hasFile('photo_files')) {
            $photoPaths = [];
            foreach ($request->file('photo_files') as $file) {
                $photoPaths[] = $file->store('photos', 'public');
            }
            $data['photos'] = $photoPaths;
        }

        $project = Project::create($data);

        // Send Email Assignment Notification
        $company = $project->company;
        if ($company && $company->user) {
            try {
                Mail::to($company->user->email)->send(new ProjectAssignedMail($project));
            } catch (\Exception $e) {
                logger()->error('Mail delivery failed: ' . $e->getMessage());
            }
        }

        return redirect()->route('projects.index')->with('success', 'Created successfully.');
    }

    public function edit(Project $project)
    {
        $activities = Activity::all();
        $companies = Company::all();
        return view('admin.projects.edit', ['item' => $project, 'activities' => $activities, 'companies' => $companies]);
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'activity_id' => 'required|exists:activities,id',
            'company_id' => 'required|exists:companies,id',
            'status' => 'required|in:upcoming,active,completed',
            'execution_date' => 'nullable|date',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
            'budget' => 'nullable|numeric',
            'coordinator_name' => 'nullable|string|max:255',
            'coordinator_phone' => 'nullable|string|max:50',
            'admin_notes' => 'nullable|string',
            'report_file' => 'nullable|file|mimes:pdf|max:20480',
            'photo_files' => 'nullable|array',
            'photo_files.*' => 'image|max:10240',
        ]);

        if ($request->hasFile('report_file')) {
            $data['report_path'] = $request->file('report_file')->store('reports', 'public');
        }

        if ($request->hasFile('photo_files')) {
            $photoPaths = $project->photos ?? [];
            foreach ($request->file('photo_files') as $file) {
                $photoPaths[] = $file->store('photos', 'public');
            }
            $data['photos'] = $photoPaths;
        }

        $oldReportPath = $project->report_path;
        $project->update($data);

        // Send Email Report Uploaded Notification
        if ($project->report_path && $project->report_path !== $oldReportPath) {
            $company = $project->company;
            if ($company && $company->user) {
                try {
                    Mail::to($company->user->email)->send(new ReportUploadedMail($project));
                } catch (\Exception $e) {
                    logger()->error('Mail delivery failed: ' . $e->getMessage());
                }
            }
        }

        return redirect()->route('projects.index')->with('success', 'Updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Deleted successfully.');
    }
}
