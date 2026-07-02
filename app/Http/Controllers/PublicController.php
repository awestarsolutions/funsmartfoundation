<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityCategory;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\Inquiry;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ActivityInquiryMail;

class PublicController extends Controller
{
    public function home()
    {
        $settings = Setting::all()->pluck('value', 'key');
        $activities = Activity::with('category')
            ->where('status', 'published')
            ->orderBy('id', 'desc')
            ->take(3)
            ->get();

        return view('home', compact('settings', 'activities'));
    }

    public function about()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('about', compact('settings'));
    }

    public function activities(Request $request)
    {
        $categories = ActivityCategory::where('status', true)->orderBy('sort_order')->get();
        
        $query = Activity::with('category')->where('status', 'published');
        
        if ($request->has('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }
        
        $activities = $query->orderBy('id', 'desc')->get();
        
        return view('activities.index', compact('activities', 'categories'));
    }

    public function activityDetail($slug)
    {
        $activity = Activity::with('category')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $relatedActivities = Activity::where('status', 'published')
            ->where('id', '!=', $activity->id)
            ->take(3)
            ->get();

        return view('activities.show', compact('activity', 'relatedActivities'));
    }

    public function impact()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('impact', compact('settings'));
    }

    public function blog(Request $request)
    {
        $categories = BlogCategory::all();
        $query = BlogPost::with('category')->where('is_published', true);
        
        if ($request->has('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }
        
        $posts = $query->orderBy('published_at', 'desc')->get();
        
        return view('blog.index', compact('posts', 'categories'));
    }

    public function blogPost($slug)
    {
        $post = BlogPost::with('category')
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $relatedPosts = BlogPost::where('is_published', true)
            ->where('id', '!=', $post->id)
            ->take(3)
            ->get();

        return view('blog.show', compact('post', 'relatedPosts'));
    }

    public function contact()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('contact', compact('settings'));
    }

    public function submitContact(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'company_name' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        Inquiry::create($data);

        try {
            Mail::to($data['email'])->send(new ActivityInquiryMail($data));
        } catch (\Exception $e) {
            // Log or ignore email failures in local/unconfigured SMTP environments
            logger()->error('Mail delivery failed: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Your inquiry has been submitted successfully. We will get in touch with you shortly.');
    }
}
