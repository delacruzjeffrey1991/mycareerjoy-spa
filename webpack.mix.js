const mix = require('laravel-mix');

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

mix.webpackConfig({
   resolve: {
      /* Path Shortcuts */
      alias: {
        /* root */
         "~": path.resolve(__dirname, "resources/js"),
         Components: path.resolve(__dirname, "resources/js/components"),
         Pages: path.resolve(__dirname, "resources/js/pages"),
         Layouts: path.resolve(__dirname, "resources/js/layouts"),
         Partials: path.resolve(__dirname, "resources/js/partials"),
         Repositories: path.resolve(__dirname, "resources/js/repositories"),
         /* Plugins */
         Plugins: path.resolve(__dirname, "resources/js/plugins")
      }
   }
})


mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');


mix.disableNotifications();

if (mix.inProduction()) {
   mix.version();
}