// Load Gulp...of course
const { src, dest, task, watch, series, parallel } = require("gulp");

// CSS related plugins
const sass = require("gulp-sass")(require("sass"));
const autoprefixer = require("gulp-autoprefixer");

// JS related plugins
const uglify = require("gulp-uglify");
const babelify = require("babelify");
const browserify = require("browserify");
const source = require("vinyl-source-stream");
const buffer = require("vinyl-buffer");
const stripDebug = require("gulp-strip-debug");

// Utility plugins
const rename = require("gulp-rename");
const sourcemaps = require("gulp-sourcemaps");
const notify = require("gulp-notify");
const plumber = require("gulp-plumber");
const options = require("gulp-options");
const gulpif = require("gulp-if");

// Browers related plugins
const browserSync = require("browser-sync").create();

// Project related constiables
const projectURL = "http://smartdelivery.local/";

const styleSRC = "./src/scss/style.scss";
const styleForm = "./src/scss/form.scss";
const styleQuote = "./src/scss/quote.scss";
const styleSpinner = "./src/scss/spinner.scss";
const styleRegister = "./src/scss/register.scss";
const styleAuth = "./src/scss/auth.scss";
const styleSlider = "./src/scss/slider.scss";
const styleFrontend = "./src/scss/frontend.scss";
const styleRates = "./src/scss/rates.scss";
const styleLanding = "./src/scss/landing.scss";
const styleURL = "./assets/css/";
const mapURL = "./";

const jsSRC = "./src/js/";
const jsAdmin = "script.js";
const jsForm = "form.js";
const jsQuote = "quote.js";
const jsRegister = "register.js";
const jsAuth = "auth.js";
const jsSlider = "slider.js";
const jsLanding = "landing.js";
const jsHelpers = "helpers.js";
const jsFiles = [
	jsAdmin,
	jsForm,
	jsSlider,
	jsLanding,
	jsAuth,
	jsRegister,
	jsQuote,
	jsHelpers,
];
const jsURL = "./assets/js/";

const styleWatch = "./src/scss/**/*.scss";
const jsWatch = "./src/js/**/*.js";
const phpWatch = "./**/*.php";

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
	src([
		styleSRC,
		styleForm,
		styleRegister,
		styleQuote,
		styleSpinner,
		styleSlider,
		styleAuth,
		styleFrontend,
		styleRates,
		styleLanding,
	])
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
