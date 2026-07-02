<x-public-layout>
    @section('title', 'Insights & News | Fun Smart Foundation')
    @section('meta_description', 'Read the latest updates, articles, and insights on sustainable development and Corporate Social Responsibility.')

    <!-- Page Header -->
    <header class="page-header">
        <div class="container">
            <h1>Latest Insights & News</h1>
            <p style="max-width: 700px; margin: 0 auto;">Discover articles, guides, and updates on sustainable CSR implementation, corporate citizenship, and social impact.</p>
        </div>
    </header>

    <!-- Main Content -->
    <section class="page-section">
        <div class="container">
            <!-- Category Chips -->
            <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: var(--space-3); margin-bottom: var(--space-8);">
                <a href="{{ route('public.blog') }}" class="btn btn-secondary {{ !request('category') ? 'active' : '' }}" style="padding: 0.5rem 1.5rem; font-size: 0.85rem; border-radius: var(--radius-pill); {{ !request('category') ? 'background-color: var(--color-primary); color: white; border-color: transparent;' : '' }}">
                    All
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('public.blog', ['category' => $cat->slug]) }}" class="btn btn-secondary {{ request('category') == $cat->slug ? 'active' : '' }}" style="padding: 0.5rem 1.5rem; font-size: 0.85rem; border-radius: var(--radius-pill); {{ request('category') == $cat->slug ? 'background-color: var(--color-primary); color: white; border-color: transparent;' : '' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>

            <!-- Blog Grid -->
            <div class="grid-3">
                @forelse($posts as $post)
                    <!-- Blog Card -->
                    <div class="card" onclick="window.location='{{ route('public.blog.show', $post->slug) }}'" style="cursor: pointer;">
                        <div class="card-img-wrap">
                            <img src="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&q=80&w=800' }}" alt="{{ $post->title }}" />
                        </div>
                        <div class="card-content">
                            @if($post->category)
                                <span class="badge">{{ $post->category->name }}</span>
                            @endif
                            <span style="font-size: 0.8rem; color: var(--color-text-light); margin-bottom: var(--space-2); display: block;">
                                {{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}
                            </span>
                            <h4>{{ $post->title }}</h4>
                            <p>{{ Str::limit(strip_tags($post->content), 120) }}</p>
                            <a href="{{ route('public.blog.show', $post->slug) }}" style="color: var(--color-primary); font-weight: 500; margin-top: auto;">Read Article →</a>
                        </div>
                    </div>
                @empty
                    <div style="grid-column: span 3; text-align: center; padding: var(--space-8); border: 2px dashed var(--color-border); border-radius: var(--radius-lg);">
                        <h4 style="color: var(--color-text-light);">No articles found matching the criteria.</h4>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</x-public-layout>
