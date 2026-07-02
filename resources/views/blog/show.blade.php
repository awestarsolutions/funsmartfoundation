<x-public-layout>
    @section('title', $post->title . ' | Fun Smart Foundation')
    @section('meta_description', Str::limit(strip_tags($post->content), 150))

    <!-- Page Header -->
    <header class="page-header">
        <div class="container">
            @if($post->category)
                <span class="badge">{{ $post->category->name }}</span>
            @endif
            <h1>{{ $post->title }}</h1>
            <p style="max-width: 700px; margin: 0 auto; color: var(--color-text-light); font-size: 0.95rem;">
                Published on {{ $post->published_at ? $post->published_at->format('F d, Y') : $post->created_at->format('F d, Y') }}
            </p>
        </div>
    </header>

    <!-- Main Content -->
    <section class="page-section">
        <div class="container" style="max-width: 800px;">
            @if($post->featured_image)
                <div style="margin-bottom: var(--space-6); border-radius: var(--radius-md); overflow: hidden; box-shadow: var(--shadow-md);">
                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" style="width: 100%; aspect-ratio: 16/9; object-fit: cover; border-radius: 0;" />
                </div>
            @endif

            <div style="font-size: 1.1rem; line-height: 1.8; color: var(--color-text-light); white-space: pre-line;">
                {!! $post->content !!}
            </div>
        </div>
    </section>

    <!-- Related Articles -->
    @if($relatedPosts->isNotEmpty())
        <section class="page-section" style="background-color: var(--color-surface); border-top: 1px solid var(--color-border);">
            <div class="container">
                <h3 style="text-align: center; margin-bottom: var(--space-8); color: var(--color-text);">Related Insights</h3>
                <div class="grid-3">
                    @foreach($relatedPosts as $related)
                        <!-- Card -->
                        <div class="card" onclick="window.location='{{ route('public.blog.show', $related->slug) }}'" style="cursor: pointer;">
                            <div class="card-img-wrap">
                                <img src="{{ $related->featured_image ? asset('storage/' . $related->featured_image) : 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&q=80&w=800' }}" alt="{{ $related->title }}" />
                            </div>
                            <div class="card-content">
                                <span style="font-size: 0.8rem; color: var(--color-text-light); margin-bottom: var(--space-2); display: block;">
                                    {{ $related->published_at ? $related->published_at->format('M d, Y') : $related->created_at->format('M d, Y') }}
                                </span>
                                <h4>{{ $related->title }}</h4>
                                <p>{{ Str::limit(strip_tags($related->content), 100) }}</p>
                                <a href="{{ route('public.blog.show', $related->slug) }}" style="color: var(--color-primary); font-weight: 500; margin-top: auto;">Read Article →</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-public-layout>
