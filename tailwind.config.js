import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
    darkMode: true,
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                "primary": "#188b46",

                "secondary": "#9cdafc",

                "accent": "#d2e863",

                "neutral": "#221a2e",

                "base-100": "#404040",

                "info": "#a4d8f4",

                "success": "#188b46",

                "warning": "#fbde4b",

                "error": "#f02832",
            }
        },

    },

    plugins: [forms],
};
