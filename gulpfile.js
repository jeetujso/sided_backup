const elixir = require('laravel-elixir');
const imagemin = require('gulp-imagemin');

elixir.config.sourcemaps = false;

//require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

gulp.task("images", function() {
    gulp.src('resources/assets/img-src/**')
        .pipe(imagemin({
          progressive: true,
          svgoPlugins: [{removeViewBox: false}]}
        ), {base: '.'})
        .pipe(gulp.dest('public/img-dist/'))
});
