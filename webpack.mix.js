const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */


mix.js('resources/js/app.js', 'public/js');

const tailwindcss = require('tailwindcss')

mix.sass('resources/sass/app.scss', 'public/css')

// admin

mix.sass('resources/sass/admin/admin.scss', 'public/assetsadmin/css')
mix.sass('resources/sass/admin/layout.scss', 'public/assetsadmin/css')

// user

mix.sass('resources/sass/user/user.scss', 'public/assets/css')
mix.sass('resources/sass/user/layout.scss', 'public/assets/css')


   .options({
      processCssUrls: false,
      postCss: [tailwindcss('tailwind.config.js')],
   })
   .version()
   .browserSync()