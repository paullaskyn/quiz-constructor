var gulp          = require('gulp'),
	sass          = require('gulp-sass'),
	browserSync   = require('browser-sync'),
	concat        = require('gulp-concat'),
	uglify        = require('gulp-uglify'),
	cleancss      = require('gulp-clean-css'),
	rename        = require('gulp-rename'),
	autoprefixer  = require('gulp-autoprefixer'),
	svgSprite     = require('gulp-svg-sprite'),
	notify        = require('gulp-notify');
	

gulp.task('browser-sync', function(){
	browserSync({
		proxy: 'webee_quiz/',
		notify: false
	});
});

gulp.task('open-style', function(){
	return gulp.src('source_static/sass/open/*.sass')
	.pipe(concat('open-style.sass'))
	.pipe(sass({ outputStyle: 'expanded' }).on("error", notify.onError()))
	.pipe(rename({ suffix: '.min', prefix : '' }))
	.pipe(autoprefixer(['last 15 versions']))
	.pipe(cleancss( {level: { 1: { specialComments: 0 } } }))
	.pipe(gulp.dest('app/static/css/open'))
	.pipe(browserSync.reload({ stream: true }))
});

gulp.task('open-script', function(){
	return gulp.src('source_static/js/open/*.js')
	.pipe(concat('open.js'))
	//.pipe(uglify())
	.pipe(rename({ suffix: '.min', prefix : '' }))
	.pipe(gulp.dest('app/static/js/open'))
	.pipe(browserSync.reload({ stream: true }))
});

gulp.task('admin-style', function(){
	return gulp.src('source_static/sass/admin/*.sass')
	.pipe(concat('admin-style.sass'))
	.pipe(sass({ outputStyle: 'expanded' }).on("error", notify.onError()))
	.pipe(rename({ suffix: '.min', prefix : '' }))
	.pipe(autoprefixer(['last 15 versions']))
	.pipe(cleancss( {level: { 1: { specialComments: 0 } } }))
	.pipe(gulp.dest('app/static/css/admin'))
	.pipe(browserSync.reload({ stream: true }))
});

gulp.task('admin-script', function(){
	return gulp.src('source_static/js/admin/*.js')
	.pipe(concat('admin.js'))
	.pipe(uglify())
	.pipe(rename({ suffix: '.min', prefix : '' }))
	.pipe(gulp.dest('app/static/js/admin'))
	.pipe(browserSync.reload({ stream: true }))
});


gulp.task('watch', function(){
	gulp.watch('source_static/sass/open/*.sass', gulp.parallel('open-style'));
	gulp.watch('source_static/js/open/*.js', gulp.parallel('open-script'));

	gulp.watch('source_static/sass/admin/*.sass', gulp.parallel('admin-style'));
	gulp.watch('source_static/js/admin/*.js', gulp.parallel('admin-script'));
});

gulp.task('default', gulp.parallel('watch', 'browser-sync', 'open-style', 'open-script', 'admin-style', 'admin-script'));