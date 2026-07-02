<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Fun Smart Foundation - Log In</title>

        <!-- Google Fonts (Outfit) -->
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

        <!-- Tailwind CSS via CDN -->
        <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            primary: "#e05e36", // Terracotta Warm Orange
                            secondary: "#4a5d4e", // Sage Green
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
                --color-primary: #e05e36;
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
            /* Inputs and buttons styling overrides */
            input[type="text"], input[type="email"], input[type="password"] {
                width: 100%;
                background-color: var(--color-surface);
                border: 1px solid var(--color-border) !important;
                border-radius: 12px !important;
                padding: 0.625rem 0.875rem !important;
                font-size: 0.875rem !important;
                color: var(--color-text) !important;
                transition: all 0.2s !important;
            }
            input:focus {
                border-color: var(--color-primary) !important;
                outline: none !important;
                box-shadow: 0 0 0 3px rgba(224, 94, 54, 0.15) !important;
            }
            /* Checkbox */
            input[type="checkbox"] {
                border: 1px solid var(--color-border) !important;
                border-radius: 4px !important;
                color: var(--color-primary) !important;
            }
            input[type="checkbox"]:focus {
                ring-color: var(--color-primary) !important;
            }
            /* Primary CTA buttons */
            .bg-gray-850, button[type="submit"], x-primary-button {
                background-color: var(--color-primary) !important;
                color: var(--color-surface) !important;
                font-weight: 600 !important;
                padding: 0.625rem 1.5rem !important;
                border-radius: 9999px !important; /* pill button matching dist */
                display: inline-flex !important;
                align-items: center !important;
                transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
                border: none !important;
                box-shadow: 0 4px 12px rgba(224, 94, 54, 0.15) !important;
                cursor: pointer;
            }
            .bg-gray-850:hover, button[type="submit"]:hover {
                background-color: #d1522e !important;
                transform: translateY(-1px);
                box-shadow: 0 6px 16px rgba(224, 94, 54, 0.25) !important;
            }
        </style>
    </head>
    <body class="font-sans antialiased text-gray-900">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-background">
            <div class="flex flex-col items-center gap-2 mb-6">
                <div class="w-16 h-16 rounded-2xl bg-secondary flex items-center justify-center text-white shadow-md">
                    <span class="material-symbols-outlined text-3xl">volunteer_activism</span>
                </div>
                <h1 class="font-bold text-2xl text-secondary uppercase tracking-widest mt-2">FSF Workspace</h1>
            </div>

            <div class="w-full sm:max-w-md mt-2 px-8 py-10 bg-white shadow-lg rounded-3xl border border-border overflow-hidden">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
