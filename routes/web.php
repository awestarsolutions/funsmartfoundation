<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PublicController;
use App\Http\Controllers\CorporateRegistrationController;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/activities', [PublicController::class, 'activities'])->name('public.activities');
Route::get('/activities/{slug}', [PublicController::class, 'activityDetail'])->name('public.activities.show');
Route::get('/activities/{slug}/book', [CorporateRegistrationController::class, 'bookActivity'])->name('activities.book');
Route::get('/impact', [PublicController::class, 'impact'])->name('public.impact');
Route::get('/blog', [PublicController::class, 'blog'])->name('public.blog');
Route::get('/blog/{slug}', [PublicController::class, 'blogPost'])->name('public.blog.show');
Route::get('/contact', [PublicController::class, 'contact'])->name('public.contact');
Route::post('/contact/submit', [PublicController::class, 'submitContact'])->name('public.contact.submit');

Route::middleware('guest')->group(function () {
    Route::get('/corporate/register', [CorporateRegistrationController::class, 'create'])->name('corporate.register');
    Route::post('/corporate/register', [CorporateRegistrationController::class, 'store']);
});

use App\Models\Activity;
use App\Models\Company;
use App\Models\Inquiry;
use App\Models\Project;

Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->hasRole('Corporate Client')) {
        $company = $user->company;
        
        if (!$company) {
            return view('corporate.no_company');
        }

        // Fetch assigned projects for this company
        $projects = Project::with(['activity'])
            ->where('company_id', $company->id)
            ->latest()
            ->get();
            
        $activeProjectsCount = $projects->where('status', 'active')->count();
        $completedProjectsCount = $projects->where('status', 'completed')->count();
        $upcomingProjectsCount = $projects->where('status', 'upcoming')->count();

        return view('corporate.dashboard', compact(
            'company',
            'projects',
            'activeProjectsCount',
            'completedProjectsCount',
            'upcomingProjectsCount'
        ));
    }

    $activitiesCount = Activity::count();
    $companiesCount = Company::where('status', true)->count();
    $inquiriesCount = Inquiry::count();
    $ongoingProjectsCount = Project::where('status', 'active')->count();
    $completedProjectsCount = Project::where('status', 'completed')->count();
    
    $recentInquiries = Inquiry::latest()->take(5)->get();
    $recentProjects = Project::with(['activity', 'company'])->latest()->take(5)->get();

    return view('dashboard', compact(
        'activitiesCount',
        'companiesCount',
        'inquiriesCount',
        'ongoingProjectsCount',
        'completedProjectsCount',
        'recentInquiries',
        'recentProjects'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:Super Admin|Admin'])->prefix('admin')->group(function () {
    // Task 3: Blog & Gallery CMS
    Route::resource('blog_categories', \App\Http\Controllers\BlogCategoryController::class);
    Route::resource('blog_posts', \App\Http\Controllers\BlogPostController::class);
    Route::resource('galleries', \App\Http\Controllers\GalleryController::class);

    // Task 5: Activities Module
    Route::resource('activities', \App\Http\Controllers\ActivityController::class);
    
    // Task 6: Inquiry System
    Route::resource('inquiries', \App\Http\Controllers\InquiryController::class);
    
    // Task 7: Corporate Client Database
    Route::resource('companies', \App\Http\Controllers\CompanyController::class);

    // Task 8: CSR Projects
    Route::resource('projects', \App\Http\Controllers\ProjectController::class);

    // User Management
    Route::resource('users', \App\Http\Controllers\UserController::class);
});

Route::middleware(['auth', 'role:Super Admin'])->prefix('admin')->group(function () {
    Route::get('/settings', [\App\Http\Controllers\SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [\App\Http\Controllers\SettingController::class, 'update'])->name('settings.update');
    
    // Task 4: Activity Categories
    Route::resource('activity_categories', \App\Http\Controllers\ActivityCategoryController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
