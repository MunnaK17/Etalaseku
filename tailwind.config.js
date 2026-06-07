import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            fontFamily: {
                sans: ['Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Base surfaces
                surface: '#131313',
                'surface-dim': '#131313',
                'surface-bright': '#393939',
                'surface-container-lowest': '#0e0e0e',
                'surface-container-low': '#1b1b1b',
                'surface-container': '#1f1f1f',
                'surface-container-high': '#2a2a2a',
                'surface-container-highest': '#353535',

                // On surfaces
                'on-surface': '#e5e2e1',
                'on-surface-variant': '#cfc3cc',
                outline: '#988e96',
                'outline-variant': '#4c444b',
                'surface-tint': '#c6c6c6',

                // Primary
                primary: '#e9c0e9',
                'on-primary': '#432646',
                'primary-container': '#e9c0e9',
                'on-primary-container': '#6c4c6e',
                'inverse-primary': '#745376',

                // Secondary
                secondary: '#e2bae2',
                'on-secondary': '#422646',
                'secondary-container': '#5b3c5d',
                'on-secondary-container': '#d0a9d0',

                // Tertiary
                tertiary: '#eae9e9',
                'on-tertiary': '#2f3131',
                'tertiary-container': '#cdcdcd',
                'on-tertiary-container': '#565757',

                // Error
                error: '#ffb4ab',
                'on-error': '#690005',
                'error-container': '#93000a',
                'on-error-container': '#ffdad6',

                // Fixed colors
                'primary-fixed': '#ffd6fe',
                'primary-fixed-dim': '#e2bae2',
                'on-primary-fixed': '#2c1130',
                'on-primary-fixed-variant': '#5b3c5e',
                'secondary-fixed': '#ffd6fe',
                'secondary-fixed-dim': '#e2bae2',
                'on-secondary-fixed': '#2c1130',
                'on-secondary-fixed-variant': '#5b3c5e',
                'tertiary-fixed': '#e3e2e2',
                'tertiary-fixed-dim': '#c6c6c6',
                'on-tertiary-fixed': '#1a1c1c',
                'on-tertiary-fixed-variant': '#464747',

                // Background
                background: '#131313',
                'on-background': '#e5e2e1',

                // Variant
                'surface-variant': '#353535',

                // Custom
                'text-muted': '#676b5f',
                'border-dark': '#1e2330',
                'inverse-surface': '#e5e2e1',
                'surface-raised': '#e9c0e9',
                'surface-neutral': '#f3f3f1',
            },
            borderRadius: {
                sm: '0.5rem',
                DEFAULT: '1rem',
                md: '1.5rem',
                lg: '2rem',
                xl: '3rem',
                full: '9999px',
            },
            spacing: {
                'stack-sm': '1rem',
                'unit': '8px',
                'gutter': '1.5rem',
                'container-margin': '2rem',
                'stack-md': '2.5rem',
                'stack-lg': '5rem',
            },
        },
    },

    plugins: [forms],
};