<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\ActivityCategory;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicRouteTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_pages_return_successful_response()
    {
        $response = $this->get(route('home'));
        $response->assertStatus(200);

        $response = $this->get(route('about'));
        $response->assertStatus(200);

        $response = $this->get(route('public.activities'));
        $response->assertStatus(200);

        $response = $this->get(route('public.impact'));
        $response->assertStatus(200);

        $response = $this->get(route('public.blog'));
        $response->assertStatus(200);

        $response = $this->get(route('public.contact'));
        $response->assertStatus(200);
    }

    public function test_detailed_activity_page_returns_successful_response()
    {
        $category = ActivityCategory::create([
            'name' => 'Education',
            'slug' => 'education',
            'status' => true
        ]);

        $activity = Activity::create([
            'name' => 'Rural Learning Labs',
            'slug' => 'rural-learning-labs',
            'activity_category_id' => $category->id,
            'short_description' => 'Test short description',
            'detailed_description' => 'Test detailed description',
            'status' => 'published'
        ]);

        $response = $this->get(route('public.activities.show', $activity->slug));
        $response->assertStatus(200);
        $response->assertSee('Rural Learning Labs');
    }

    public function test_detailed_blog_page_returns_successful_response()
    {
        $category = BlogCategory::create([
            'name' => 'Sustainability',
            'slug' => 'sustainability'
        ]);

        $post = BlogPost::create([
            'title' => 'Green Initiatives in 2026',
            'slug' => 'green-initiatives-in-2026',
            'blog_category_id' => $category->id,
            'content' => 'Test blog content',
            'is_published' => true,
            'published_at' => now()
        ]);

        $response = $this->get(route('public.blog.show', $post->slug));
        $response->assertStatus(200);
        $response->assertSee('Green Initiatives in 2026');
    }

    public function test_contact_form_submission_creates_inquiry()
    {
        $data = [
            'name' => 'Alex Corporate',
            'email' => 'alex@corporate.com',
            'phone' => '+1234567890',
            'company_name' => 'Corporate Inc',
            'message' => 'We are interested in tree plantation CSR.'
        ];

        $response = $this->post(route('public.contact.submit'), $data);
        $response->assertRedirect();
        
        $this->assertDatabaseHas('inquiries', [
            'name' => 'Alex Corporate',
            'email' => 'alex@corporate.com',
            'company_name' => 'Corporate Inc',
            'message' => 'We are interested in tree plantation CSR.'
        ]);
    }

    public function test_dashboard_displays_correct_counters()
    {
        $user = \App\Models\User::factory()->create();

        $response = $this->actingAs($user)->get(route('dashboard'));
        $response->assertStatus(200);
        $response->assertSee('Dashboard');
        $response->assertSee('Activities');
        $response->assertSee('Partners');
        $response->assertSee('Inquiries');
    }

    public function test_corporate_client_dashboard_displays_no_company_fallback_when_unlinked()
    {
        // Set up role
        \Spatie\Permission\Models\Role::create(['name' => 'Corporate Client']);

        $user = \App\Models\User::factory()->create();
        $user->assignRole('Corporate Client');

        $response = $this->actingAs($user)->get(route('dashboard'));
        $response->assertStatus(200);
        $response->assertSee('No Corporate Connection Found');
    }

    public function test_corporate_client_dashboard_renders_assigned_projects_when_linked()
    {
        // Set up roles and entities
        \Spatie\Permission\Models\Role::create(['name' => 'Corporate Client']);

        $user = \App\Models\User::factory()->create();
        $user->assignRole('Corporate Client');

        $company = \App\Models\Company::create([
            'name' => 'Test Corporation',
            'industry' => 'Tech',
            'status' => true,
            'user_id' => $user->id
        ]);

        $category = ActivityCategory::create([
            'name' => 'Education',
            'slug' => 'education',
            'status' => true
        ]);

        $activity = Activity::create([
            'name' => 'Test Initiative',
            'slug' => 'test-initiative',
            'activity_category_id' => $category->id,
            'short_description' => 'Test short description',
            'detailed_description' => 'Test detailed description',
            'status' => 'published'
        ]);

        $project = \App\Models\Project::create([
            'activity_id' => $activity->id,
            'company_id' => $company->id,
            'status' => 'active',
            'execution_date' => now()->toDateString(),
            'coordinator_name' => 'John Coordinator'
        ]);

        $response = $this->actingAs($user)->get(route('dashboard'));
        $response->assertStatus(200);
        $response->assertSee('Corporate Workspace');
        $response->assertSee('Test Corporation');
        $response->assertSee('Test Initiative');
        $response->assertSee('John Coordinator');
    }

    public function test_contact_form_submission_dispatches_inquiry_mail()
    {
        \Illuminate\Support\Facades\Mail::fake();

        $data = [
            'name' => 'Alex Corporate',
            'email' => 'alex@corporate.com',
            'phone' => '+1234567890',
            'company_name' => 'Corporate Inc',
            'message' => 'We are interested in tree plantation CSR.'
        ];

        $response = $this->post(route('public.contact.submit'), $data);
        $response->assertRedirect();

        \Illuminate\Support\Facades\Mail::assertSent(\App\Mail\ActivityInquiryMail::class, function ($mail) use ($data) {
            return $mail->hasTo('alex@corporate.com') && $mail->data['name'] === 'Alex Corporate';
        });
    }

    public function test_project_creation_dispatches_assigned_mail()
    {
        \Illuminate\Support\Facades\Mail::fake();

        // Create Admin User
        $admin = \App\Models\User::factory()->create();
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'Super Admin']);
        $admin->assignRole('Super Admin');

        // Create Corporate User
        $corporateUser = \App\Models\User::factory()->create(['email' => 'partner@corp.com']);
        $company = \App\Models\Company::create([
            'name' => 'Test Corp',
            'industry' => 'Tech',
            'status' => true,
            'user_id' => $corporateUser->id
        ]);

        $category = ActivityCategory::create([
            'name' => 'Education',
            'slug' => 'education',
            'status' => true
        ]);

        $activity = Activity::create([
            'name' => 'Test Project',
            'slug' => 'test-project',
            'activity_category_id' => $category->id,
            'short_description' => 'Desc',
            'detailed_description' => 'Detail',
            'status' => 'published'
        ]);

        $projectData = [
            'activity_id' => $activity->id,
            'company_id' => $company->id,
            'status' => 'upcoming',
            'execution_date' => now()->toDateString(),
            'budget' => 1000.00
        ];

        $response = $this->actingAs($admin)->post(route('projects.store'), $projectData);
        $response->assertRedirect(route('projects.index'));

        \Illuminate\Support\Facades\Mail::assertSent(\App\Mail\ProjectAssignedMail::class, function ($mail) use ($corporateUser) {
            return $mail->hasTo('partner@corp.com');
        });
    }

    public function test_project_report_upload_dispatches_report_uploaded_mail()
    {
        \Illuminate\Support\Facades\Mail::fake();

        // Create Admin User
        $admin = \App\Models\User::factory()->create();
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'Super Admin']);
        $admin->assignRole('Super Admin');

        // Create Corporate User
        $corporateUser = \App\Models\User::factory()->create(['email' => 'partner@corp.com']);
        $company = \App\Models\Company::create([
            'name' => 'Test Corp',
            'industry' => 'Tech',
            'status' => true,
            'user_id' => $corporateUser->id
        ]);

        $category = ActivityCategory::create([
            'name' => 'Education',
            'slug' => 'education',
            'status' => true
        ]);

        $activity = Activity::create([
            'name' => 'Test Project',
            'slug' => 'test-project',
            'activity_category_id' => $category->id,
            'short_description' => 'Desc',
            'detailed_description' => 'Detail',
            'status' => 'published'
        ]);

        // Create existing project
        $project = \App\Models\Project::create([
            'activity_id' => $activity->id,
            'company_id' => $company->id,
            'status' => 'active',
            'execution_date' => now()->toDateString(),
        ]);

        // Upload fake pdf report
        $file = \Illuminate\Http\UploadedFile::fake()->create('report.pdf', 100, 'application/pdf');

        $projectUpdateData = [
            'activity_id' => $activity->id,
            'company_id' => $company->id,
            'status' => 'completed',
            'execution_date' => now()->toDateString(),
            'report_file' => $file
        ];

        $response = $this->actingAs($admin)->put(route('projects.update', $project), $projectUpdateData);
        $response->assertRedirect(route('projects.index'));

        \Illuminate\Support\Facades\Mail::assertSent(\App\Mail\ReportUploadedMail::class, function ($mail) {
            return $mail->hasTo('partner@corp.com');
        });
    }
}
