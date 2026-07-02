import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                'headline-md': ['Inter', 'sans-serif'],
            },
            colors: {
                primary: 'var(--color-primary)',
                'on-primary': 'var(--color-on-primary)',
                secondary: 'var(--color-secondary)',
                'on-secondary': 'var(--color-on-secondary)',
                background: 'var(--color-background)',
                'on-background': 'var(--color-on-background)',
                surface: 'var(--color-surface)',
                'on-surface': 'var(--color-on-surface)',
                'surface-container-lowest': 'var(--color-surface-container-lowest)',
                'surface-variant': 'var(--color-surface-variant)',
                'on-surface-variant': 'var(--color-on-surface-variant)',
                border: 'var(--color-border)',
                text: 'var(--color-text)',
            }
        },
    },

    plugins: [forms],
    corePlugins: {
        preflight: false,
    },
};
