<x-public-layout>
    @section('title', 'CSR Activities | Fun Smart Foundation')
    @section('meta_description', 'Browse through all active Corporate Social Responsibility initiatives and community projects managed by Fun Smart Foundation.')

    <!-- Page Header -->
    <header class="page-header">
        <div class="container">
            <h1>Our CSR Initiatives</h1>
            <p style="max-width: 700px; margin: 0 auto;">Creating Impact Across Diverse Social Causes through strategic planning, professional execution, and transparent reporting.</p>
        </div>
    </header>

    <!-- Main Content -->
    <section class="page-section">
        <div class="container">
            <!-- Category Filter Chips -->
            <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: var(--space-3); margin-bottom: var(--space-8);">
                <a href="{{ route('public.activities') }}" class="btn btn-secondary {{ !request('category') ? 'active' : '' }}" style="padding: 0.5rem 1.5rem; font-size: 0.85rem; border-radius: var(--radius-pill); {{ !request('category') ? 'background-color: var(--color-primary); color: white; border-color: transparent;' : '' }}">
                    All
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('public.activities', ['category' => $cat->slug]) }}" class="btn btn-secondary {{ request('category') == $cat->slug ? 'active' : '' }}" style="padding: 0.5rem 1.5rem; font-size: 0.85rem; border-radius: var(--radius-pill); {{ request('category') == $cat->slug ? 'background-color: var(--color-primary); color: white; border-color: transparent;' : '' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>

            <div class="grid-3">
                @forelse($activities as $activity)
                    <!-- Activity Card -->
                    <div class="card" onclick="window.location='{{ route('public.activities.show', $activity->slug) }}'" style="cursor: pointer;">
                        <div class="card-img-wrap">
                            <img src="{{ $activity->cover_image ? asset('storage/' . $activity->cover_image) : 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&q=80&w=800' }}" alt="{{ $activity->name }}" />
                        </div>
                        <div class="card-content">
                            @if($activity->category)
                                <span class="badge">{{ $activity->category->name }}</span>
                            @endif
                            <h4>{{ $activity->name }}</h4>
                            <p>{{ Str::limit($activity->short_description, 120) }}</p>
                            <a href="{{ route('public.activities.show', $activity->slug) }}" style="color: var(--color-primary); font-weight: 500; margin-top: auto;">View Details →</a>
                        </div>
                    </div>
                @empty
                    <div style="grid-column: span 3; text-align: center; padding: var(--space-8); border: 2px dashed var(--color-border); border-radius: var(--radius-lg);">
                        <h4 style="color: var(--color-text-light);">No initiatives found matching the criteria.</h4>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div style="max-width: 600px; margin: 0 auto; position: relative; z-index: 2;">
            <h2>Let's Build Meaningful Impact Together.</h2>
            <p>Partner with Fun Smart Foundation to build stronger communities through responsible, transparent, and measurable CSR programs.</p>
            <div style="margin-top: var(--space-6); display: flex; gap: var(--space-4); justify-content: center;">
                <a href="{{ route('public.contact') }}" class="btn btn-secondary" style="background-color: var(--color-surface); color: var(--color-primary); border-color: transparent;">Schedule a Consultation</a>
            </div>
        </div>
    </section>
</x-public-layout>
