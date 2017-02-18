var gulp = require('gulp'),
    $ = require('gulp-load-plugins')(),
    src = ['assets/js/**/*.js'],
    animappSrc = ['assets/animapp/index.js', 'assets/animapp/**/*.js'],
    log = console.log

gulp.task('concat', ['concat:default', 'concat:animapp'])

gulp.task('concat:default', function () {
    return gulp.src(src)

        .pipe($.concat('build.min.js'))

        .pipe(gulp.dest('web/js'))
})

gulp.task('concat:animapp', function () {
    return gulp.src(animappSrc)
        .pipe($.sourcemaps.init())
        .pipe($.concat('animapp.min.js'))
        .pipe($.uglify())
        .pipe($.sourcemaps.write('/'))
        .pipe(gulp.dest('web/js'))
})

gulp.task('concat:animapp:dev', function () {
    return gulp.src(animappSrc)
        .pipe($.concat('animapp.min.js'))
        .pipe(gulp.dest('web/js'))
})

gulp.task('watch', function () {
    gulp.watch([].concat(src, animappSrc), ['concat'])
        .on('change', function (event) {
            log('File: ' + event.path + ' has been ' + event.type)
        })
})

gulp.task('watch:dev', function () {
    gulp.watch([].concat(src, animappSrc), ['concat:animapp:dev'])
        .on('change', function (event) {
            log('File: ' + event.path + ' has been ' + event.type)
        })
})

gulp.task('default', ['concat'])