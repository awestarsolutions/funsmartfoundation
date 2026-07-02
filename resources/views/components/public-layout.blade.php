<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Fun Smart Foundation | Meaningful Social Impact')</title>
  <meta name="description" content="@yield('meta_description', 'Fun Smart Foundation partners with organizations to design, execute, and measure CSR initiatives that create sustainable change.')" />
  
  <link rel="stylesheet" href="{{ asset('css/main-B8HQUWIb.css') }}">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

  <style>
    :root {
        --color-primary: {{ \App\Models\Setting::where('key', 'theme_color')->value('value') ?? '#e05e36' }};
        --color-secondary: #4a5d4e;
        --color-background: #f4f4f0;
        --color-surface: #ffffff;
        --color-border: #e2dfd8;
        --color-text: #2b2b2b;
    }
    
    /* Make navbar pill always visible over dark backgrounds */
    .navbar .container {
        background-color: #ffffffe6 !important;
        backdrop-filter: blur(12px) !important;
        -webkit-backdrop-filter: blur(12px) !important;
        box-shadow: var(--shadow-md) !important;
        padding: 0.75rem 1.5rem !important;
        border: 1px solid rgba(255,255,255,.5) !important;
    }
    .navbar .nav-brand {
        color: var(--color-primary) !important;
    }

    @media (max-width: 767px) {
      .nav-links.active {
        display: flex !important;
        flex-direction: column;
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background-color: var(--color-surface);
        padding: var(--space-4);
        border-bottom: 1px solid var(--color-border);
        box-shadow: var(--shadow-md);
        gap: var(--space-3);
      }
      .mobile-menu-btn {
        display: block !important;
        background: none;
        border: none;
        font-size: 1.1rem;
        font-weight: bold;
        color: var(--color-text);
        cursor: pointer;
      }
    }
  </style>
</head>
<body>

  <!-- Navigation -->
  <nav class="navbar">
    <div class="container">
      @php $current_logo = (isset($settings) && isset($settings['site_logo'])) ? $settings['site_logo'] : ($site_logo ?? null); @endphp
      <a href="{{ route('home') }}" class="nav-brand" style="display: flex; align-items: center; gap: 0.5rem;">
          @if($current_logo)
              <img src="{{ asset('storage/' . $current_logo) }}" alt="Logo" style="height: 2rem;">
          @endif
          {{ \App\Models\Setting::where('key', 'site_name')->value('value') ?? 'Fun Smart Foundation' }}
      </a>
      <div class="nav-links">
        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
        <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a>
        <a href="{{ route('public.activities') }}" class="nav-link {{ request()->routeIs('public.activities*') ? 'active' : '' }}">Activities</a>
        <a href="{{ route('public.impact') }}" class="nav-link {{ request()->routeIs('public.impact') ? 'active' : '' }}">Impact</a>
        <a href="{{ route('public.blog') }}" class="nav-link {{ request()->routeIs('public.blog*') ? 'active' : '' }}">Blog</a>
        <a href="{{ route('public.contact') }}" class="nav-link {{ request()->routeIs('public.contact') ? 'active' : '' }}">Contact</a>
        
        @auth
            <a href="{{ route('dashboard') }}" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.85rem;">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="nav-link">Sign In</a>
            <a href="{{ route('public.contact') }}" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.85rem;">Partner With Us</a>
        @endauth
      </div>
      <button class="mobile-menu-btn" style="display: none;">Menu</button>
    </div>
  </nav>

  <!-- Content Slot -->
  {{ $slot }}

  <!-- Footer -->
  <footer class="site-footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-col">
          @php $current_logo = (isset($settings) && isset($settings['site_logo'])) ? $settings['site_logo'] : ($site_logo ?? null); @endphp
          <h4 style="color: white; display: flex; align-items: center; gap: 0.5rem;">
              @if($current_logo)
                  <img src="{{ asset('storage/' . $current_logo) }}" alt="Logo" style="height: 2rem; filter: brightness(0) invert(1);">
              @endif
              {{ \App\Models\Setting::where('key', 'site_name')->value('value') ?? 'Fun Smart Foundation' }}
          </h4>
          <p>Purpose-driven CSR implementation for organizations committed to creating measurable social impact.</p>
        </div>
        <div class="footer-col">
          <h4>Navigation</h4>
          <a href="{{ route('home') }}" class="footer-link">Home</a>
          <a href="{{ route('about') }}" class="footer-link">About</a>
          <a href="{{ route('public.activities') }}" class="footer-link">CSR Initiatives</a>
          <a href="{{ route('public.impact') }}" class="footer-link">Impact</a>
          <a href="{{ route('public.contact') }}" class="footer-link">Contact</a>
        </div>
        <div class="footer-col">
          <h4>Get in Touch</h4>
          <p>Email: contact@funsmartfoundation.org</p>
          <p>Phone: +1 234 567 890</p>
          <p>Address: 123 Impact Way, Sustainability City</p>
        </div>
        <div class="footer-col">
          <h4>Connect</h4>
          <a href="#" class="footer-link">LinkedIn</a>
          <a href="#" class="footer-link">Instagram</a>
          <a href="#" class="footer-link">Facebook</a>
        </div>
      </div>
      <div class="footer-bottom">
        <p>&copy; 2026 Fun Smart Foundation. All rights reserved.</p>
        <p>Designed for Impact</p>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script>
    const n = document.querySelector(".navbar");
    n && window.addEventListener("scroll", () => {
      window.scrollY > 50 ? n.classList.add("scrolled") : n.classList.remove("scrolled")
    });

    const i = document.querySelector(".mobile-menu-btn"),
          l = document.querySelector(".nav-links");
    if (i && l) {
      i.addEventListener("click", () => {
        l.classList.toggle("active");
      });
    }

    const u = document.querySelectorAll(".reveal"),
          d = new IntersectionObserver(o => {
            o.forEach(r => {
              r.isIntersecting && (r.target.classList.add("active"), d.unobserve(r.target))
            })
          }, { threshold: .1 });
    u.forEach(o => d.observe(o));
  </script>
</body>
</html>
