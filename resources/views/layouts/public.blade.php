<!DOCTYPE html>
<html class="scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Fun Smart Foundation | Professional CSR Excellence')</title>
    <meta name="description" content="@yield('meta_description', 'Fun Smart Foundation partners with organizations to design, execute, and measure Corporate Social Responsibility initiatives.')"/>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --color-primary: {{ $theme_color ?? '#e05e36' }};
            --color-secondary: #4a5d4e;
            --color-background: #f4f4f0;
            --color-surface: #ffffff;
            --color-border: #e2dfd8;
            --color-text: #2b2b2b;
        }
    </style>
</head>
<body class="bg-background text-on-background font-sans overflow-x-hidden">
    <!-- Top Navigation Bar -->
    <header x-data="{ open: false }" class="fixed top-0 z-50 w-full bg-surface-container-lowest/90 backdrop-blur-md h-20 border-b border-secondary/5 transition-all duration-300">
        <nav class="flex justify-between items-center w-full px-gutter max-w-container-max mx-auto h-full relative">
            @php $current_logo = (isset($settings) && isset($settings['site_logo'])) ? $settings['site_logo'] : ($site_logo ?? null); @endphp
            <a href="{{ route('home') }}" class="font-headline-md text-headline-md font-bold text-primary flex items-center gap-2">
                @if($current_logo)
                    <img src="{{ asset('storage/' . $current_logo) }}" alt="Logo" class="h-10">
                @endif
                {{ $site_name ?? 'Fun Smart Foundation' }}
            </a>

            <!-- Desktop Links -->
            <div class="hidden md:flex items-center space-x-8">
                <a class="font-body-md text-body-md {{ request()->routeIs('home') ? 'text-primary border-b-2 border-primary pb-1' : 'text-on-surface-variant hover:text-primary transition-colors' }}" href="{{ route('home') }}">Home</a>
                <a class="font-body-md text-body-md {{ request()->routeIs('about') ? 'text-primary border-b-2 border-primary pb-1' : 'text-on-surface-variant hover:text-primary transition-colors' }}" href="{{ route('about') }}">About</a>
                <a class="font-body-md text-body-md {{ request()->routeIs('public.activities*') ? 'text-primary border-b-2 border-primary pb-1' : 'text-on-surface-variant hover:text-primary transition-colors' }}" href="{{ route('public.activities') }}">CSR Initiatives</a>
                <a class="font-body-md text-body-md {{ request()->routeIs('public.impact') ? 'text-primary border-b-2 border-primary pb-1' : 'text-on-surface-variant hover:text-primary transition-colors' }}" href="{{ route('public.impact') }}">Impact</a>
                <a class="font-body-md text-body-md {{ request()->routeIs('public.blog*') ? 'text-primary border-b-2 border-primary pb-1' : 'text-on-surface-variant hover:text-primary transition-colors' }}" href="{{ route('public.blog') }}">Blog</a>
                <a class="font-body-md text-body-md {{ request()->routeIs('public.contact') ? 'text-primary border-b-2 border-primary pb-1' : 'text-on-surface-variant hover:text-primary transition-colors' }}" href="{{ route('public.contact') }}">Contact</a>
            </div>

            <div class="hidden md:flex items-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="border-2 border-primary text-primary px-6 py-2.5 rounded-lg font-label-md hover:bg-primary/5 transition-all text-sm">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-on-surface-variant hover:text-primary font-body-md text-sm transition-colors">
                        Sign In
                    </a>
                    <a href="{{ route('public.contact') }}" class="bg-primary text-on-primary px-6 py-2.5 rounded-lg font-label-md hover:opacity-90 transition-opacity text-sm">
                        Partner With Us
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <button @click="open = !open" class="md:hidden flex items-center p-2 text-primary">
                <span class="material-symbols-outlined text-3xl" x-text="open ? 'close' : 'menu'">menu</span>
            </button>

            <!-- Mobile Dropdown Menu -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="absolute top-20 left-0 w-full bg-surface-container-lowest border-b border-secondary/5 py-6 px-gutter flex flex-col space-y-4 shadow-xl z-40 md:hidden"
                 style="display: none;">
                <a class="font-body-md text-lg {{ request()->routeIs('home') ? 'text-primary font-semibold' : 'text-on-surface-variant' }}" href="{{ route('home') }}" @click="open = false">Home</a>
                <a class="font-body-md text-lg {{ request()->routeIs('about') ? 'text-primary font-semibold' : 'text-on-surface-variant' }}" href="{{ route('about') }}" @click="open = false">About</a>
                <a class="font-body-md text-lg {{ request()->routeIs('public.activities*') ? 'text-primary font-semibold' : 'text-on-surface-variant' }}" href="{{ route('public.activities') }}" @click="open = false">CSR Initiatives</a>
                <a class="font-body-md text-lg {{ request()->routeIs('public.impact') ? 'text-primary font-semibold' : 'text-on-surface-variant' }}" href="{{ route('public.impact') }}" @click="open = false">Impact</a>
                <a class="font-body-md text-lg {{ request()->routeIs('public.blog*') ? 'text-primary font-semibold' : 'text-on-surface-variant' }}" href="{{ route('public.blog') }}" @click="open = false">Blog</a>
                <a class="font-body-md text-lg {{ request()->routeIs('public.contact') ? 'text-primary font-semibold' : 'text-on-surface-variant' }}" href="{{ route('public.contact') }}" @click="open = false">Contact</a>
                
                <hr class="border-secondary/10" />

                @auth
                    <a href="{{ route('dashboard') }}" class="bg-primary text-on-primary px-6 py-3 rounded-lg font-label-md text-center hover:opacity-90 transition-opacity">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-on-surface-variant hover:text-primary font-body-md text-center py-2 transition-colors">
                        Sign In
                    </a>
                    <a href="{{ route('public.contact') }}" class="bg-primary text-on-primary px-6 py-3 rounded-lg font-label-md text-center hover:opacity-90 transition-opacity">
                        Partner With Us
                    </a>
                @endauth
            </div>
        </nav>
    </header>

    <!-- Main Content Area -->
    <main class="pt-20">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-primary dark:bg-surface-container-lowest text-on-primary dark:text-on-surface full-width border-t border-secondary/10 mt-20">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-stack-lg px-gutter py-section-v-desktop max-w-container-max mx-auto">
            <div class="space-y-6">
                @php $current_logo = (isset($settings) && isset($settings['site_logo'])) ? $settings['site_logo'] : ($site_logo ?? null); @endphp
                <div class="font-headline-md text-headline-md text-on-primary dark:text-on-surface font-bold flex items-center gap-2">
                    @if($current_logo)
                        <img src="{{ asset('storage/' . $current_logo) }}" alt="Logo" class="h-10 filter invert brightness-0 dark:filter-none">
                    @endif
                    {{ $site_name ?? 'Fun Smart Foundation' }}
                </div>
                <p class="font-body-md text-sm opacity-70">Empowering global communities through professional, scalable, and transparent corporate social responsibility initiatives.</p>
                <div class="flex space-x-4">
                    <a class="w-10 h-10 rounded-full border border-on-primary/20 flex items-center justify-center hover:bg-on-primary/10 transition-colors" href="#">
                        <span class="material-symbols-outlined text-sm">public</span>
                    </a>
                    <a class="w-10 h-10 rounded-full border border-on-primary/20 flex items-center justify-center hover:bg-on-primary/10 transition-colors" href="mailto:contact@funsmartfoundation.org">
                        <span class="material-symbols-outlined text-sm">alternate_email</span>
                    </a>
                    <a class="w-10 h-10 rounded-full border border-on-primary/20 flex items-center justify-center hover:bg-on-primary/10 transition-colors" href="#">
                        <span class="material-symbols-outlined text-sm">hub</span>
                    </a>
                </div>
            </div>
            <div>
                <h5 class="font-label-md text-tertiary-fixed mb-6 uppercase tracking-widest text-xs">Overview</h5>
                <ul class="space-y-4 font-body-md text-sm opacity-80">
                    <li><a class="hover:text-tertiary-fixed transition-colors" href="{{ route('about') }}">Our Mission</a></li>
                    <li><a class="hover:text-tertiary-fixed transition-colors" href="{{ route('public.impact') }}">Our Impact</a></li>
                    <li><a class="hover:text-tertiary-fixed transition-colors" href="{{ route('about') }}">Governance & Team</a></li>
                </ul>
            </div>
            <div>
                <h5 class="font-label-md text-tertiary-fixed mb-6 uppercase tracking-widest text-xs">CSR Initiatives</h5>
                <ul class="space-y-4 font-body-md text-sm opacity-80">
                    <li><a class="hover:text-tertiary-fixed transition-colors" href="{{ route('public.activities') }}">Education & Skill Development</a></li>
                    <li><a class="hover:text-tertiary-fixed transition-colors" href="{{ route('public.activities') }}">Healthcare & Wellbeing</a></li>
                    <li><a class="hover:text-tertiary-fixed transition-colors" href="{{ route('public.activities') }}">Environmental Sustainability</a></li>
                    <li><a class="hover:text-tertiary-fixed transition-colors" href="{{ route('public.activities') }}">Women Empowerment</a></li>
                </ul>
            </div>
            <div>
                <h5 class="font-label-md text-tertiary-fixed mb-6 uppercase tracking-widest text-xs">Newsletter</h5>
                <p class="font-body-md text-xs mb-4 opacity-70">Monthly insights into corporate impact and sustainable development.</p>
                <form class="flex flex-col gap-2">
                    <input class="bg-white/10 border-white/20 rounded-lg py-3 px-4 text-sm focus:ring-tertiary-fixed focus:border-tertiary-fixed placeholder:text-white/40" placeholder="Email Address" type="email"/>
                    <button class="bg-tertiary-fixed text-on-tertiary-fixed px-4 py-3 rounded-lg font-label-md text-xs hover:bg-tertiary-fixed/90 transition-all">Subscribe</button>
                </form>
            </div>
        </div>
        <div class="max-w-container-max mx-auto px-gutter py-8 border-t border-on-primary/10 flex flex-col md:flex-row justify-between items-center gap-4 text-[10px] uppercase tracking-widest font-bold opacity-60">
            <p>© 2026 Fun Smart Foundation. All rights reserved.</p>
            <div class="flex gap-8">
                <a class="hover:text-white transition-colors" href="#">Privacy Policy</a>
                <a class="hover:text-white transition-colors" href="#">Terms of Service</a>
                <a class="hover:text-white transition-colors" href="#">Cookie Settings</a>
            </div>
        </div>
    </footer>

    <!-- Intersection Observer for simple scroll reveals -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observerOptions = {
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('opacity-100');
                        entry.target.classList.remove('opacity-0', 'translate-y-8');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('section > div').forEach(el => {
                el.classList.add('transition-all', 'duration-700', 'opacity-0', 'translate-y-8');
                observer.observe(el);
            });
        });
    </script>
</body>
</html>
