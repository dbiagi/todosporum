var gulp = require('gulp'),
    concat = require('gulp-concat'),
    sourcemaps = require('gulp-sourcemaps'),
    minify = require('gulp-minify'),
    uglify = require('gulp-uglify'),
    src = ['src/core.js', 'src/**/*.js'],
    log = console.log

gulp.task('concat', function () {
    return gulp.src(src)
        .pipe(sourcemaps.init())
        .pipe(concat('animapp.js'))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('dist'))
})

gulp.task('watch', function () {
    gulp.watch(['src/**/*.js'], ['concat'])
        .on('change', function (event) {
            log('File: ' + event.path + ' has been ' + event.type)
        })
})

gulp.task('default', ['concat'])