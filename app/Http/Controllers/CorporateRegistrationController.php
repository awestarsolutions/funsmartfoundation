<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Company;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class CorporateRegistrationController extends Controller
{
    /**
     * Show the corporate registration view.
     */
    public function create(Request $request)
    {
        $redirect = $request->query('redirect');
        return view('auth.corporate-register', compact('redirect'));
    }

    /**
     * Handle an incoming corporate registration request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'company_name' => ['required', 'string', 'max:255'],
            'industry' => ['nullable', 'string', 'max:255'],
            'is_poc_same' => ['nullable', 'boolean'],
            'primary_poc_name' => ['required_if:is_poc_same,0', 'nullable', 'string', 'max:255'],
            'poc_email' => ['required_if:is_poc_same,0', 'nullable', 'email', 'max:255'],
            'poc_phone' => ['nullable', 'string', 'max:50'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('Corporate Client');

        $isPocSame = $request->boolean('is_poc_same');

        Company::create([
            'user_id' => $user->id,
            'name' => $request->company_name,
            'industry' => $request->industry,
            'primary_poc_name' => $isPocSame ? $user->name : $request->primary_poc_name,
            'poc_email' => $isPocSame ? $user->email : $request->poc_email,
            'poc_phone' => $request->poc_phone,
            'status' => true,
        ]);

        Auth::login($user);

        if ($request->redirect) {
            return redirect($request->redirect);
        }

        return redirect(route('dashboard', absolute: false));
    }

    /**
     * Book an activity.
     */
    public function bookActivity(Request $request, $slug)
    {
        $activity = Activity::where('slug', $slug)->firstOrFail();

        if (!Auth::check()) {
            return redirect()->route('corporate.register', ['redirect' => route('activities.book', $slug)]);
        }

        $user = Auth::user();
        
        if (!$user->hasRole('Corporate Client')) {
            return redirect()->route('dashboard')->with('error', 'Only Corporate Clients can book activities directly.');
        }

        $company = $user->company;

        if (!$company) {
            return redirect()->route('dashboard')->with('error', 'No company profile found.');
        }

        // Check if already booked
        $existingProject = Project::where('activity_id', $activity->id)
            ->where('company_id', $company->id)
            ->first();

        if ($existingProject) {
            return redirect()->route('dashboard')->with('info', 'You have already booked this activity.');
        }

        Project::create([
            'activity_id' => $activity->id,
            'company_id' => $company->id,
            'status' => 'upcoming',
        ]);

        return redirect()->route('dashboard')->with('success', 'Activity booked successfully as a new project!');
    }
}
