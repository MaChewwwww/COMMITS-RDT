const mix = require('laravel-mix');

// Compile JavaScript
mix.js('resources/js/app.js', 'public/js')
   // Compile CSS (if using Sass)
   .sass('resources/sass/app.scss', 'public/css') // Uncomment if using Sass
   // Compile CSS with Tailwind
   .postCss('resources/css/app.css', 'public/css', [
       require('tailwindcss'),
       require('autoprefixer'),
   ])
   // Enable versioning for cache busting
   .version(); 
