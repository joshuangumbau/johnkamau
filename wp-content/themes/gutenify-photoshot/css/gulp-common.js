var gulp = require("gulp");
var babel = require('gulp-babel');
var wpPot = require("gulp-wp-pot");
const zip = require("gulp-zip");
var rtlcss = require("gulp-rtlcss");
var rename = require("gulp-rename");
var sass = require("gulp-sass")(require("node-sass"));
var uglifyJS = require('gulp-uglify');
var package = require('./package.json');
const replace = require('gulp-replace');
const cleanCSS = require('gulp-clean-css');

gulp.task('uglifyJS', async function () {
	gulp.src(['./js/admin.js'])
		.pipe(babel({presets: ['@babel/preset-env'] }))
		.pipe(uglifyJS())
		.pipe(rename('admin.min.js'))
		.pipe(gulp.dest('js'));

	gulp.src(['./js/animate.js'])
		.pipe(babel({presets: ['@babel/preset-env'] }))
		.pipe(uglifyJS())
		.pipe(rename('animate.min.js'))
		.pipe(gulp.dest('js'));
});

gulp.task("rtl", function () {
	return gulp
		.src("style.css")
		.pipe(rtlcss())
		.pipe(rename({ suffix: "-rtl" }))
		.pipe(gulp.dest("./"));
});

gulp.task("pot", function () {
	return gulp
		.src(["*.php", "inc/**/**.php", "patterns/**/**.php"])
		.pipe(
			wpPot({
				domain: `${package.name}`,
				package: `${package.name}`,
				team: `${package.author} ${package.email}`,
			})
		)
		.pipe(gulp.dest(`languages/${package.name}.pot`));
});

gulp.task("copy", function () {
	return gulp.src([
		"**",
		"!*.DS_Store",
		"!*.stylelintrc.json",
		"!*.eslintrc",
		"!*.git",
		"!*.gitattributes",
		"!*.github",
		"!*.gitignore",
		"!README.md",
		"!composer.json",
		"!composer.lock",
		"!node_modules/**",
		"!vendor/**",
		"!package-lock.json",
		"!package.json",
		"!.travis.yml",
		"!phpcs.xml.dist",
		"!sass/**",
		"!*.css.map",
		"!*.js.map",
		"!*.vscode",
		"!build/**",
		"!bundle/**",
		"!yarn.lock",
		"!gulpfile.js",
		"!theme-1.json",
		"!src/**",
		"!theme_readme.txt",
		"!gulp-common.js",
		"!yarn-error.log",
	]).pipe(gulp.dest(`./bundle/${package.version}/${package.name}`));
});

gulp.task("zipit", function () {
	return gulp
		.src(`./bundle/${package.version}/**`)
		.pipe(zip(`${package.name}-${package.version}.zip`))
		.pipe(gulp.dest("bundle"));
});


/**
 * BUNDLE TASKS
 */
gulp.task('minify-css', () => {
	return gulp.src(["css/admin-style.css","css/animate.css"])
	  .pipe(cleanCSS({compatibility: 'ie8'}))
	  .pipe(rename(function (path) {
		path.basename += ".min";
	  }))
	  .pipe(gulp.dest('css'));
});

gulp.task("bundle", gulp.series(  "uglifyJS", 'minify-css', "rtl", "pot", "copy", "zipit"));

/**
 * BUNDLE TASKS ENDS
 */


gulp.task('watch',  function() {
	// watch for CSS changes
	gulp.watch('src/sass/**/*.scss', gulp.series(  "rtl"));
	gulp.watch('src/**/*.js', gulp.series( "uglifyJS" ));
});
