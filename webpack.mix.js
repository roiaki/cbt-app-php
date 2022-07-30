const mix = require('laravel-mix');
const Manifest = require('laravel-mix/src/Manifest');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
 mix.js('resources/js/app.js', 'public/js')
  .js('resources/js/main.js', 'public/js')
  .js('resources/js/sample01.js', 'public/js')
  .postCss('resources/css/app.css', 'public/css', [
 ]).vue();
