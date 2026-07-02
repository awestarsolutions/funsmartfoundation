<x-public-layout>
    @section('title', $activity->name . ' | Fun Smart Foundation')
    @section('meta_description', Str::limit($activity->short_description, 150))

    <!-- Page Header -->
    <header class="page-header">
        <div class="container">
            @if($activity->category)
                <span class="badge">{{ $activity->category->name }}</span>
            @endif
            <h1>{{ $activity->name }}</h1>
            <p style="max-width: 700px; margin: 0 auto; color: var(--color-text-light); font-size: 0.95rem;">
                Location: <strong>{{ $activity->location }}</strong> | Duration: <strong>{{ $activity->duration ?? 'Ongoing' }}</strong>
            </p>
        </div>
    </header>

    <!-- Main Content Split Layout -->
    <section class="page-section">
        <div class="container">
            
            @if(session('success'))
                <div style="background-color: #d1e7dd; color: #0f5132; padding: var(--space-4); border-radius: var(--radius-md); border: 1px solid #badbcc; margin-bottom: var(--space-6); font-size: 0.95rem; font-weight: bold; display: flex; align-items: center; gap: var(--space-2);">
                    <span class="material-symbols-outlined">check_circle</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid-2-col" style="align-items: flex-start; gap: var(--space-8);">
                <!-- Left Side Details -->
                <div style="display: flex; flex-direction: column; gap: var(--space-6);">
                    <div>
                        <h2>Overview</h2>
                        <p style="font-size: 1.15rem; color: var(--color-text); font-weight: 500; line-height: 1.7;">
                            {{ $activity->short_description }}
                        </p>
                        <div style="color: var(--color-text-light); font-size: 1.1rem; line-height: 1.8; white-space: pre-line;">
                            {!! nl2br(e($activity->detailed_description)) !!}
                        </div>
                    </div>

                    @if(!empty($activity->objectives))
                        <div class="card" style="padding: var(--space-5); background-color: var(--color-surface);">
                            <h3>Objectives & Key Targets</h3>
                            <div style="color: var(--color-text-light); font-size: 1rem; line-height: 1.7; white-space: pre-line;">
                                {!! nl2br(e($activity->objectives)) !!}
                            </div>
                        </div>
                    @endif

                    @if(!empty($activity->expected_impact) || !empty($activity->beneficiary_information))
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: var(--space-5); border-top: 1px solid var(--color-border); pt: var(--space-5);">
                            @if(!empty($activity->expected_impact))
                                <div>
                                    <strong style="display: block; margin-bottom: var(--space-2); color: var(--color-text);">Expected Impact</strong>
                                    <p style="color: var(--color-text-light); font-size: 0.95rem;">{{ $activity->expected_impact }}</p>
                                </div>
                            @endif
                            @if(!empty($activity->beneficiary_information))
                                <div>
                                    <strong style="display: block; margin-bottom: var(--space-2); color: var(--color-text);">Beneficiary Scope</strong>
                                    <p style="color: var(--color-text-light); font-size: 0.95rem;">{{ $activity->beneficiary_information }}</p>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Right Side Sticky Form -->
                <div style="display: flex; flex-direction: column; gap: var(--space-6); position: sticky; top: 100px;">
                    <div class="card" style="padding: var(--space-6); background-color: var(--color-surface);">
                        <h3 style="margin-bottom: var(--space-4);">Ready to get started?</h3>
                        <a href="{{ route('activities.book', $activity->slug) }}" class="btn btn-primary" style="display: block; text-align: center; font-size: 1.1rem; padding: var(--space-3) var(--space-4);">
                            Book This Activity
                        </a>
                        <p style="font-size: 0.85rem; color: var(--color-text-light); margin-top: var(--space-3); text-align: center;">
                            Requires a Corporate Account. You can create one during checkout.
                        </p>
                    </div>

                    <div class="card" style="padding: var(--space-6); background-color: var(--color-surface);">
                        <h3>Or Enquire</h3>
                        <p style="font-size: 0.85rem; color: var(--color-text-light); margin-bottom: var(--space-4);">
                            Let's discuss how we can execute this CSR activity tailored to your corporate objective.
                        </p>

                    <form method="POST" action="{{ route('public.contact.submit') }}" class="contact-form">
                        @csrf
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" required placeholder="Jane Doe" />
                        </div>
                        <div class="form-group">
                            <label for="email">Work Email</label>
                            <input type="email" id="email" name="email" required placeholder="jane@company.com" />
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" id="phone" name="phone" placeholder="+1 (234) 567-8900" />
                        </div>
                        <div class="form-group">
                            <label for="company_name">Company Name</label>
                            <input type="text" id="company_name" name="company_name" placeholder="Acme Corp" />
                        </div>
                        <div class="form-group">
                            <label for="message">Comments / Notes</label>
                            <textarea id="message" name="message" required rows="4" placeholder="Describe your budget, timing, or target region...">I am interested in partnering on: {{ $activity->name }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-top: var(--space-3); width: 100%;">Submit Inquiry</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Activities -->
    @if($relatedActivities->isNotEmpty())
        <section class="page-section" style="background-color: var(--color-surface); border-top: 1px solid var(--color-border);">
            <div class="container">
                <h3 style="text-align: center; margin-bottom: var(--space-8); color: var(--color-text);">Other CSR Initiatives</h3>
                <div class="grid-3">
                    @foreach($relatedActivities as $related)
                        <!-- Related Card -->
                        <div class="card" onclick="window.location='{{ route('public.activities.show', $related->slug) }}'" style="cursor: pointer;">
                            <div class="card-img-wrap">
                                <img src="{{ $related->cover_image ? asset('storage/' . $related->cover_image) : 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&q=80&w=800' }}" alt="{{ $related->name }}" />
                            </div>
                            <div class="card-content">
                                @if($related->category)
                                    <span class="badge">{{ $related->category->name }}</span>
                                @endif
                                <h4>{{ $related->name }}</h4>
                                <p>{{ Str::limit($related->short_description, 100) }}</p>
                                <a href="{{ route('public.activities.show', $related->slug) }}" style="color: var(--color-primary); font-weight: 500; margin-top: auto;">View Details →</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-public-layout>
