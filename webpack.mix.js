const { mix } = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
	.js('resources/assets/js/admin.js', 'public/js')
	.sass('resources/assets/sass/app.scss', 'public/css')
	.sass('resources/assets/sass/admin.scss', 'public/css')
	.options({
    	processCssUrls: false
   });;

mix.browserSync({
	open: 'external',
	host: 'sided.dev',
	proxy: 'sided.dev',
	port: 8000
});

if (mix.config.inProduction) {
    mix.version();
}

// Until Mix supports image optimization, we're using `gulp images`. Once mix is tagged again, remove `gulp-imagemin`, `laravel-elixer`, and gulp.