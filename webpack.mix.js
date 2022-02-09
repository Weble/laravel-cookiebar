const mix = require('laravel-mix')

mix
    .js('resources/js/cookie.js', 'resources/dist')
    .postCss('resources/css/cookie.css', 'resources/dist', [
        require('tailwindcss'),
        require('autoprefixer'),
    ])
