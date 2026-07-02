<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Admin | {{ \App\Models\Setting::where('key', 'site_name')->value('value') ?? 'Fun Smart Foundation' }}</title>

        <!-- Google Fonts (Outfit matching frontend) -->
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

        <!-- AlpineJS -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <!-- Tailwind CSS via CDN -->
        <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            primary: "#e05e36", // Terracotta Warm Orange
                            secondary: "#4a5d4e", // Sage Green
                            accent: "#f4a261",
                            background: "#f4f4f0", // Warm Clay/Sand
                            surface: "#ffffff",
                            border: "#e2dfd8",
                            "on-surface": "#2b2b2b"
                        }
                    }
                }
            }
        </script>

        <style>
            :root {
                --color-primary: {{ $theme_color ?? '#e05e36' }};
                --color-secondary: #4a5d4e;
                --color-background: #f4f4f0;
                --color-surface: #ffffff;
                --color-border: #e2dfd8;
                --color-text: #2b2b2b;
            }
            body {
                background-color: var(--color-background);
                font-family: "Outfit", system-ui, -apple-system, sans-serif;
                color: var(--color-text);
            }
            /* Modern tables style matching dist */
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 1.5rem;
                font-size: 0.875rem;
                background-color: var(--color-surface);
                border-radius: 12px;
                overflow: hidden;
            }
            th {
                background-color: #e2dfd8;
                color: var(--color-text);
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                text-align: left;
                padding: 0.75rem 1rem;
                border-bottom: 2px solid rgba(224, 94, 54, 0.1);
            }
            td {
                padding: 0.75rem 1rem;
                border-bottom: 1px solid var(--color-border);
                color: var(--color-text);
            }
            tr:hover {
                background-color: rgba(224, 94, 54, 0.02);
            }
            /* Inputs and form elements override matching dist */
            input[type="text"], input[type="email"], input[type="number"], input[type="date"], input[type="password"], select, textarea {
                width: 100%;
                background-color: var(--color-surface);
                border: 1px solid var(--color-border) !important;
                border-radius: 12px !important;
                padding: 0.625rem 0.875rem !important;
                font-size: 0.875rem !important;
                color: var(--color-text) !important;
                transition: all 0.2s !important;
            }
            input:focus, select:focus, textarea:focus {
                border-color: var(--color-primary) !important;
                outline: none !important;
                box-shadow: 0 0 0 3px rgba(224, 94, 54, 0.15) !important;
            }
            /* Branded primary action buttons */
            .bg-blue-500, button[type="submit"], .bg-blue-500:hover, a.bg-blue-500 {
                background-color: var(--color-primary) !important;
                color: var(--color-surface) !important;
                font-weight: 600 !important;
                padding: 0.625rem 1.25rem !important;
                border-radius: 9999px !important; /* pill button matching dist */
                display: inline-flex !important;
                align-items: center !important;
                transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
                border: none !important;
                box-shadow: 0 4px 12px rgba(224, 94, 54, 0.15) !important;
                cursor: pointer;
            }
            .bg-blue-500:hover, button[type="submit"]:hover, a.bg-blue-500:hover {
                background-color: #d1522e !important;
                transform: translateY(-1px);
                box-shadow: 0 6px 16px rgba(224, 94, 54, 0.25) !important;
            }
            /* Links and text-indigo-600 */
            .text-indigo-600 {
                color: var(--color-primary) !important;
                font-weight: 600 !important;
            }
            .text-indigo-600:hover {
                text-decoration: underline !important;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-background flex">
            <!-- Sidebar (Branded in Sage Green for contrast and styling) -->
            <aside class="w-64 bg-secondary text-white shadow-xl hidden md:block border-r border-border/10">
                <div class="h-20 flex items-center px-6 border-b border-white/10">
                    <a href="{{ route('dashboard') }}" class="font-bold text-lg text-white tracking-wider uppercase flex items-center gap-2">
                        @if(isset($site_logo) && $site_logo)
                            <img src="{{ asset('storage/' . $site_logo) }}" alt="Logo" class="h-8">
                        @endif
                        {{ $site_name ?? 'FSF Workspace' }}
                    </a>
                </div>
                <div class="h-[calc(100vh-80px)] px-4 py-6 overflow-y-auto bg-secondary">
                    <ul class="space-y-1 font-medium">
                        <li>
                            <a href="{{ route('dashboard') }}" class="flex items-center p-3 rounded-xl transition-all {{ request()->routeIs('dashboard') ? 'bg-white/10 text-white font-semibold' : 'text-white/70 hover:text-white hover:bg-white/5' }}">
                                <span class="material-symbols-outlined mr-3 text-lg">dashboard</span>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        
                        @if(Auth::user()->hasRole('Super Admin|Admin'))
                            <li>
                                <a href="{{ route('activities.index') }}" class="flex items-center p-3 rounded-xl transition-all {{ request()->routeIs('activities*') ? 'bg-white/10 text-white font-semibold' : 'text-white/70 hover:text-white hover:bg-white/5' }}">
                                    <span class="material-symbols-outlined mr-3 text-lg">volunteer_activism</span>
                                    <span>Activities</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('inquiries.index') }}" class="flex items-center p-3 rounded-xl transition-all {{ request()->routeIs('inquiries*') ? 'bg-white/10 text-white font-semibold' : 'text-white/70 hover:text-white hover:bg-white/5' }}">
                                    <span class="material-symbols-outlined mr-3 text-lg">chat_bubble</span>
                                    <span>Inquiries</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('companies.index') }}" class="flex items-center p-3 rounded-xl transition-all {{ request()->routeIs('companies*') ? 'bg-white/10 text-white font-semibold' : 'text-white/70 hover:text-white hover:bg-white/5' }}">
                                    <span class="material-symbols-outlined mr-3 text-lg">domain</span>
                                    <span>Companies</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('projects.index') }}" class="flex items-center p-3 rounded-xl transition-all {{ request()->routeIs('projects*') ? 'bg-white/10 text-white font-semibold' : 'text-white/70 hover:text-white hover:bg-white/5' }}">
                                    <span class="material-symbols-outlined mr-3 text-lg">assignment</span>
                                    <span>Projects</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('blog_categories.index') }}" class="flex items-center p-3 rounded-xl transition-all {{ request()->routeIs('blog_categories*') ? 'bg-white/10 text-white font-semibold' : 'text-white/70 hover:text-white hover:bg-white/5' }}">
                                    <span class="material-symbols-outlined mr-3 text-lg">tag</span>
                                    <span>Blog Categories</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('blog_posts.index') }}" class="flex items-center p-3 rounded-xl transition-all {{ request()->routeIs('blog_posts*') ? 'bg-white/10 text-white font-semibold' : 'text-white/70 hover:text-white hover:bg-white/5' }}">
                                    <span class="material-symbols-outlined mr-3 text-lg">article</span>
                                    <span>Blog Posts</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('galleries.index') }}" class="flex items-center p-3 rounded-xl transition-all {{ request()->routeIs('galleries*') ? 'bg-white/10 text-white font-semibold' : 'text-white/70 hover:text-white hover:bg-white/5' }}">
                                    <span class="material-symbols-outlined mr-3 text-lg">imagesmode</span>
                                    <span>Gallery</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('users.index') }}" class="flex items-center p-3 rounded-xl transition-all {{ request()->routeIs('users*') ? 'bg-white/10 text-white font-semibold' : 'text-white/70 hover:text-white hover:bg-white/5' }}">
                                    <span class="material-symbols-outlined mr-3 text-lg">group</span>
                                    <span>Users</span>
                                </a>
                            </li>
                        @endif

                        @if(Auth::user()->hasRole('Super Admin'))
                            <li>
                                <a href="{{ route('activity_categories.index') }}" class="flex items-center p-3 rounded-xl transition-all {{ request()->routeIs('activity_categories*') ? 'bg-white/10 text-white font-semibold' : 'text-white/70 hover:text-white hover:bg-white/5' }}">
                                    <span class="material-symbols-outlined mr-3 text-lg">category</span>
                                    <span>Activity Categories</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('settings.index') }}" class="flex items-center p-3 rounded-xl transition-all {{ request()->routeIs('settings*') ? 'bg-white/10 text-white font-semibold' : 'text-white/70 hover:text-white hover:bg-white/5' }}">
                                    <span class="material-symbols-outlined mr-3 text-lg">settings</span>
                                    <span>Settings</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="flex-grow flex flex-col min-h-screen overflow-x-hidden">
                @include('layouts.navigation')

                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-white border-b border-gray-200">
                        <div class="max-w-7xl mx-auto py-6 px-6 sm:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="flex-grow p-6 sm:p-8">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
