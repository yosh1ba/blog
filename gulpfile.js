// npx gulp で監視開始

var gulp = require( 'gulp' );
var sass = require( 'gulp-sass' );
var plumber = require( 'gulp-plumber' );
var notify = require( 'gulp-notify' );
var sassGlob = require( 'gulp-sass-glob' );
var mmq = require( 'gulp-merge-media-queries' );
var gulpStylelint = require( 'gulp-stylelint' );
var postcss = require( 'gulp-postcss' );
var autoprefixer = require( 'autoprefixer' );
var cssdeclsort = require( 'css-declaration-sorter' );
var header = require( 'gulp-header' );
var browserSync = require('browser-sync');

gulp.task( 'default', function() {
    return gulp.watch('scss/**/*.scss', function() {
        return (
      gulp
        .src( 'scss/**/*.scss' )
        .pipe( plumber({ errorHandler: notify.onError( 'Error: <%= error.message %>' ) }) )
        .pipe( sassGlob() )
        .pipe( sass({ outputStyle: 'expanded' }) )
        .pipe( postcss([ autoprefixer() ]) )
        .pipe( postcss([ cssdeclsort({ order: 'alphabetically' }) ]) )
        .pipe( mmq() )
        .pipe(header('@charset "UTF-8";\n\n'))
        .pipe( gulp.dest( './' ) )
        .pipe(browserSync.stream())
        );
    });
});
