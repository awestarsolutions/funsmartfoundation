<x-public-layout>
    @section('title', 'Fun Smart Foundation | Meaningful Social Impact')
    @section('meta_description', 'Fun Smart Foundation partners with organizations to design, execute, and measure CSR initiatives that create sustainable change.')

    <!-- Hero Section -->
    <div class="relative min-h-screen flex items-center justify-center pt-24 pb-12 overflow-hidden">
        <!-- Background Image & Overlay -->
        <div class="absolute inset-0 z-0">
            @php $heroImage = \App\Models\Setting::where('key', 'home_hero_image')->value('value'); @endphp
            <img src="{{ $heroImage ? asset('storage/' . $heroImage) : 'https://images.unsplash.com/photo-1559027615-cd4628902d4a?auto=format&fit=crop&q=80&w=1600' }}" alt="Volunteers" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/50 to-transparent"></div>
        </div>
        
        <div class="container relative z-10 px-6 mx-auto">
            <div class="max-w-3xl">
                <!-- Glassmorphism Hero Card -->
                <div class="bg-white/10 backdrop-blur-xl border border-white/20 p-8 md:p-12 rounded-3xl shadow-2xl">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/20 backdrop-blur-md border border-white/30 text-white text-sm font-medium mb-6">
                        <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                        Empowering Communities
                    </div>
                    
                    <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight mb-6">
                        {!! nl2br(e(\App\Models\Setting::where('key', 'home_hero_title')->value('value') ?? 'Creating Meaningful Social Impact')) !!}
                    </h1>
                    
                    <p class="text-lg text-white/90 mb-8 leading-relaxed max-w-2xl">
                        {{ \App\Models\Setting::where('key', 'home_hero_subtitle')->value('value') ?? 'Fun Smart Foundation partners with organizations to design, execute, and measure Corporate Social Responsibility initiatives that create sustainable change across communities.' }}
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('public.activities') }}" class="px-8 py-4 rounded-xl bg-[var(--color-primary)] text-white font-semibold text-center hover:bg-[#d1522e] transition-all shadow-lg hover:shadow-[var(--color-primary)]/40 hover:-translate-y-1" style="color: white !important;">
                            Explore Initiatives
                        </a>
                        <a href="{{ route('public.contact') }}" class="px-8 py-4 rounded-xl bg-white/10 backdrop-blur-md border border-white/30 text-white font-semibold text-center hover:bg-white/20 transition-all hover:-translate-y-1" style="color: white !important;">
                            Partner With Us
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Trust Bar (Glassmorphic) -->
    <div class="relative -mt-16 z-20 container mx-auto px-6">
        <div class="bg-white/80 backdrop-blur-lg border border-white/40 shadow-xl rounded-2xl p-8 flex flex-col md:flex-row items-center justify-between gap-8">
            <p class="text-sm font-bold uppercase tracking-wider text-gray-500 whitespace-nowrap mb-0" style="margin-bottom: 0;">Trusted By</p>
            <div class="flex flex-wrap justify-center gap-8 md:gap-12 opacity-60 grayscale">
                @php 
                    $logo1 = \App\Models\Setting::where('key', 'home_trust_logo_1')->value('value');
                    $logo2 = \App\Models\Setting::where('key', 'home_trust_logo_2')->value('value');
                    $logo3 = \App\Models\Setting::where('key', 'home_trust_logo_3')->value('value');
                    $logo4 = \App\Models\Setting::where('key', 'home_trust_logo_4')->value('value');
                @endphp
                <img src="{{ $logo1 ? asset('storage/' . $logo1) : 'https://upload.wikimedia.org/wikipedia/commons/2/2f/Google_2015_logo.svg' }}" alt="Partner 1" class="h-8 hover:grayscale-0 hover:opacity-100 transition-all duration-300" />
                <img src="{{ $logo2 ? asset('storage/' . $logo2) : 'https://upload.wikimedia.org/wikipedia/commons/9/96/Microsoft_logo_%282012%29.svg' }}" alt="Partner 2" class="h-8 hover:grayscale-0 hover:opacity-100 transition-all duration-300" />
                <img src="{{ $logo3 ? asset('storage/' . $logo3) : 'https://upload.wikimedia.org/wikipedia/commons/b/b1/Tata_Consultancy_Services_Logo.svg' }}" alt="Partner 3" class="h-8 hover:grayscale-0 hover:opacity-100 transition-all duration-300" />
                <img src="{{ $logo4 ? asset('storage/' . $logo4) : 'https://upload.wikimedia.org/wikipedia/commons/a/a9/Amazon_logo.svg' }}" alt="Partner 4" class="h-8 hover:grayscale-0 hover:opacity-100 transition-all duration-300" />
            </div>
        </div>
    </div>

    <!-- About Preview Section -->
    <section class="py-24 bg-[var(--color-background)] relative overflow-hidden" style="padding: 6rem 0;">
        <!-- Decorative blobs -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-[var(--color-primary)] opacity-10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-green-500 opacity-10 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-3xl md:text-5xl font-bold text-gray-900 leading-tight mb-6">
                        {!! nl2br(e(\App\Models\Setting::where('key', 'home_about_title')->value('value') ?? 'Building Communities. Delivering Lasting Impact.')) !!}
                    </h2>
                    <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                        {{ \App\Models\Setting::where('key', 'home_about_text')->value('value') ?? 'Fun Smart Foundation is a not-for-profit organization committed to developing resilient communities through carefully planned social development initiatives. We collaborate with corporations, institutions, and local communities to implement impactful CSR programs.' }}
                    </p>
                    <a href="{{ route('about') }}" class="inline-flex items-center gap-2 font-semibold hover:gap-4 transition-all" style="color: var(--color-primary);">
                        Discover Our Approach <span class="material-symbols-outlined">arrow_forward</span>
                    </a>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-white/60 backdrop-blur-xl border border-white p-6 rounded-2xl shadow-lg hover:-translate-y-2 transition-transform duration-300">
                        <div class="w-12 h-12 rounded-xl bg-orange-100 flex items-center justify-center mb-4" style="color: var(--color-primary);">
                            <span class="material-symbols-outlined">handshake</span>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 mb-2">End-to-End CSR</h4>
                        <p class="text-gray-600 text-sm">Strategic planning and on-ground execution.</p>
                    </div>
                    <div class="bg-white/60 backdrop-blur-xl border border-white p-6 rounded-2xl shadow-lg hover:-translate-y-2 transition-transform duration-300 sm:translate-y-8">
                        <div class="w-12 h-12 rounded-xl bg-green-100 text-green-600 flex items-center justify-center mb-4">
                            <span class="material-symbols-outlined">nature_people</span>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 mb-2">Sustainable Dev</h4>
                        <p class="text-gray-600 text-sm">Creating long-term value for communities.</p>
                    </div>
                    <div class="bg-white/60 backdrop-blur-xl border border-white p-6 rounded-2xl shadow-lg hover:-translate-y-2 transition-transform duration-300">
                        <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center mb-4">
                            <span class="material-symbols-outlined">analytics</span>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 mb-2">Transparent Reports</h4>
                        <p class="text-gray-600 text-sm">Detailed impact reporting and governance.</p>
                    </div>
                    <div class="bg-white/60 backdrop-blur-xl border border-white p-6 rounded-2xl shadow-lg hover:-translate-y-2 transition-transform duration-300 sm:translate-y-8">
                        <div class="w-12 h-12 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center mb-4">
                            <span class="material-symbols-outlined">group</span>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 mb-2">Expert Team</h4>
                        <p class="text-gray-600 text-sm">Experienced implementation professionals.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Impact Statistics (Glassmorphic Dark Section) -->
    <section class="py-24 relative bg-gray-900 overflow-hidden" style="padding: 6rem 0;">
        <!-- Abstract background -->
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 32px 32px;"></div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">Every Initiative Creates a Ripple Effect</h2>
                <p class="text-gray-400 text-lg">Over the years, our programs have contributed towards improving livelihoods and strengthening communities.</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-white/5 backdrop-blur-lg border border-white/10 p-8 rounded-3xl text-center hover:bg-white/10 transition-colors">
                    <h3 class="text-4xl md:text-5xl font-black mb-2" style="color: var(--color-primary);">100+</h3>
                    <p class="text-gray-300 font-medium">Projects Delivered</p>
                </div>
                <div class="bg-white/5 backdrop-blur-lg border border-white/10 p-8 rounded-3xl text-center hover:bg-white/10 transition-colors">
                    <h3 class="text-4xl md:text-5xl font-black text-blue-400 mb-2">50+</h3>
                    <p class="text-gray-300 font-medium">Corporate Partners</p>
                </div>
                <div class="bg-white/5 backdrop-blur-lg border border-white/10 p-8 rounded-3xl text-center hover:bg-white/10 transition-colors">
                    <h3 class="text-4xl md:text-5xl font-black text-green-400 mb-2">25K+</h3>
                    <p class="text-gray-300 font-medium">Lives Impacted</p>
                </div>
                <div class="bg-white/5 backdrop-blur-lg border border-white/10 p-8 rounded-3xl text-center hover:bg-white/10 transition-colors">
                    <h3 class="text-4xl md:text-5xl font-black text-purple-400 mb-2">15+</h3>
                    <p class="text-gray-300 font-medium">Communities</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CSR Initiatives -->
    <section class="py-24 bg-gray-50" style="padding: 6rem 0;">
        <div class="container mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Creating Impact Across Diverse Causes</h2>
                <p class="text-gray-600 text-lg">Our initiatives are designed to create long-term, measurable improvements across multiple sectors.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($activities as $activity)
                    <div class="group relative bg-white rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 cursor-pointer border border-gray-100 flex flex-col" onclick="window.location='{{ route('public.activities.show', $activity->slug) }}'">
                        <div class="aspect-[4/3] overflow-hidden relative">
                            <img src="{{ $activity->cover_image ? asset('storage/' . $activity->cover_image) : 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&q=80&w=800' }}" alt="{{ $activity->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                            <!-- Glassmorphism badge overlay -->
                            @if($activity->category)
                                <div class="absolute top-4 left-4 bg-white/70 backdrop-blur-md border border-white/50 font-bold px-4 py-1 rounded-full text-sm shadow-sm" style="color: var(--color-primary);">
                                    {{ $activity->category->name }}
                                </div>
                            @endif
                        </div>
                        <div class="p-8 flex flex-col flex-grow">
                            <h4 class="text-xl font-bold text-gray-900 mb-3 transition-colors hover:text-[#e05e36]">{{ $activity->name }}</h4>
                            <p class="text-gray-600 mb-6 line-clamp-3">{{ Str::limit($activity->short_description, 120) }}</p>
                            <span class="mt-auto inline-flex items-center gap-2 font-semibold group-hover:gap-4 transition-all" style="color: var(--color-primary);">
                                View Details <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 text-gray-500">No initiatives found.</div>
                @endforelse
            </div>
            
            <div class="text-center mt-16">
                <a href="{{ route('public.activities') }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-xl border-2 border-gray-200 text-gray-700 font-semibold transition-all hover:border-[#e05e36] hover:text-[#e05e36]">
                    View All Initiatives
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section with Glassmorphism overlay -->
    <section class="py-24 relative overflow-hidden" style="padding: 6rem 0;">
        <!-- Background -->
        <div class="absolute inset-0" style="background-color: var(--color-primary);"></div>
        <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-white opacity-10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
        <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-black opacity-10 rounded-full blur-3xl translate-y-1/3 -translate-x-1/3"></div>
        
        <div class="container mx-auto px-6 relative z-10 text-center">
            <div class="max-w-3xl mx-auto bg-white/10 backdrop-blur-2xl border border-white/20 p-12 md:p-16 rounded-[3rem] shadow-2xl">
                <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">
                    {{ \App\Models\Setting::where('key', 'home_cta_title')->value('value') ?? 'Let\'s Build Meaningful Impact Together.' }}
                </h2>
                <p class="text-white opacity-90 text-lg md:text-xl mb-10 max-w-2xl mx-auto">
                    {{ \App\Models\Setting::where('key', 'home_cta_subtitle')->value('value') ?? 'Partner with Fun Smart Foundation to build stronger communities through responsible, transparent, and measurable CSR programs.' }}
                </p>
                <a href="{{ route('public.contact') }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-xl bg-white font-bold text-lg hover:bg-gray-50 hover:scale-105 transition-all shadow-xl" style="color: var(--color-primary);">
                    Schedule a Consultation
                </a>
            </div>
        </div>
    </section>

    <!-- Impact Gallery Section -->
    <section class="py-24 bg-[var(--color-background)] relative overflow-hidden">
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-6">Impact Created By Us</h2>
                <p class="text-gray-600 text-lg">A visual journey through the communities we've transformed and the lives we've touched.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 md:gap-6 auto-rows-[250px]">
                <!-- Large Feature Image -->
                <div class="md:col-span-2 md:row-span-2 rounded-3xl overflow-hidden relative group shadow-lg">
                    <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&q=80&w=1200" alt="Impact" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-8">
                        <div class="translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                            <h4 class="text-white text-2xl font-bold mb-2">Community Education</h4>
                            <p class="text-white/80">Empowering youth through accessible learning centers.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Smaller Images -->
                <div class="rounded-3xl overflow-hidden relative group shadow-md">
                    <img src="https://images.unsplash.com/photo-1593113589914-075568e09413?auto=format&fit=crop&q=80&w=600" alt="Impact" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <span class="text-white font-bold bg-white/20 backdrop-blur-md px-4 py-2 rounded-full border border-white/30">Healthcare</span>
                    </div>
                </div>
                
                <div class="rounded-3xl overflow-hidden relative group shadow-md">
                    <img src="https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?auto=format&fit=crop&q=80&w=600" alt="Impact" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <span class="text-white font-bold bg-white/20 backdrop-blur-md px-4 py-2 rounded-full border border-white/30">Environment</span>
                    </div>
                </div>
                
                <div class="rounded-3xl overflow-hidden relative group shadow-md">
                    <img src="https://images.unsplash.com/photo-1542810634-71277d95dcbb?auto=format&fit=crop&q=80&w=600" alt="Impact" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <span class="text-white font-bold bg-white/20 backdrop-blur-md px-4 py-2 rounded-full border border-white/30">Agriculture</span>
                    </div>
                </div>
                
                <div class="rounded-3xl overflow-hidden relative group shadow-md">
                    <img src="https://images.unsplash.com/photo-1509099836639-18ba1795216d?auto=format&fit=crop&q=80&w=600" alt="Impact" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <span class="text-white font-bold bg-white/20 backdrop-blur-md px-4 py-2 rounded-full border border-white/30">Skill Training</span>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <a href="{{ route('public.impact') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white text-[var(--color-primary)] font-bold border border-gray-200 shadow-sm hover:shadow-md transition-all hover:-translate-y-1">
                    View Full Impact Report
                </a>
            </div>
        </div>
    </section>
</x-public-layout>
