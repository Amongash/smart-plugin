// Load Gulp...of course
const { src, dest, task, watch, series, parallel } = require("gulp");

// CSS related plugins
var sass = require("gulp-sass");
var autoprefixer = require("gulp-autoprefixer");

// JS related plugins
var uglify = require("gulp-uglify");
var babelify = require("babelify");
var browserify = require("browserify");
var source = require("vinyl-source-stream");
var buffer = require("vinyl-buffer");
var stripDebug = require("gulp-strip-debug");

// Utility plugins
var rename = require("gulp-rename");
var sourcemaps = require("gulp-sourcemaps");
var notify = require("gulp-notify");
var plumber = require("gulp-plumber");
var options = require("gulp-options");
var gulpif = require("gulp-if");

// Browers related plugins
var browserSync = require("browser-sync").create();

// Project related variables
var projectURL = "http://wordpress.local/";

var styleSRC = "./src/scss/style.scss";
var styleForm = "./src/scss/form.scss";
var styleQuote = "./src/scss/quote.scss";
var styleRegister = "./src/scss/register.scss";
var styleAuth = "./src/scss/auth.scss";
var styleSlider = "./src/scss/slider.scss";
var styleURL = "./assets/css/";
var mapURL = "./";

var jsSRC = "./src/js/";
var jsAdmin = "script.js";
var jsForm = "form.js";
var jsQuote = "quote.js";
var jsRegister = "register.js";
var jsAuth = "auth.js";
var jsSlider = "slider.js";
var jsFiles = [jsAdmin, jsForm, jsSlider, jsAuth, jsRegister, jsQuote];
var jsURL = "./assets/js/";

var styleWatch = "./src/scss/**/*.scss";
var jsWatch = "./src/js/**/*.js";
var phpWatch = "./**/*.php";

// Tasks
function browser_sync(done) {
	browserSync.init({
		proxy: projectURL,
		injectChanges: true,
		open: false,
	});
	done();
}

function style(done) {
	src([styleSRC, styleForm, styleRegister, styleQuote, styleSlider, styleAuth])
		.pipe(sourcemaps.init())
		.pipe(
			sass({
				errLogToConsole: true,
				outputStyle: "compressed",
			})
		)
		.on("error", console.error.bind(console))
		.pipe(autoprefixer())
		.pipe(sourcemaps.write(mapURL))
		.pipe(dest(styleURL))
		.pipe(browserSync.stream());
	done();
}

function js(done) {
	jsFiles.map(function (entry) {
		browserify({
			entries: [jsSRC + entry],
		})
			.transform(babelify, { presets: ["@babel/preset-env"] })
			.bundle()
			.pipe(source(entry))
			.pipe(buffer())
			.pipe(gulpif(options.has("production"), stripDebug()))
			.pipe(sourcemaps.init({ loadMaps: true }))
			.pipe(uglify())
			.pipe(sourcemaps.write("."))
			.pipe(dest(jsURL))
			.pipe(browserSync.stream());
	});
	done();
}

function triggerPlumber(src, url) {
	return src(src).pipe(plumber()).pipe(dest(url));
}

function reload(done) {
	browserSync.reload();
	done();
}

function watch_files(done) {
	watch(phpWatch, reload);
	watch(styleWatch, series(style, reload));
	watch(jsWatch, series(js, reload));
	src(jsURL + "script.js").pipe(
		notify({ message: "Gulp is Watching, Happy Coding!" })
	);
	done();
}

task("style", style);
task("js", js);
task("default", parallel(style, js));
task("watch", series(watch_files, browser_sync));
