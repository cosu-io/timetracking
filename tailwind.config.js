const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                'cosu': {
                    '50': '#f0faff',
                    '100': '#e0f4fe',
                    '200': '#b9ebfe',
                    '300': '#94e3fe',
                    '400': '#35cbfb',
                    '500': '#0bb5ec',
                    '600': '#0093ca',
                    '700': '#0175a3',
                    '800': '#056387',
                    '900': '#0b516f',
                },
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/line-clamp'),
    ],
};