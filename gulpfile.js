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
var reload = browserSync.reload;

// Project related variables
var projectURL = "http://wordpress.local/";

var styleSRC = "./src/admin/scss/style.scss";
var styleURL = "./assets/admin/";
var mapURL = "./";

var jsSRC = "./src/admin/js/script.js";
var jsURL = "./assets/admin/";

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
  _src(styleSRC)
    .pipe(init())
    .pipe(
      sass({
        errLogToConsole: true,
        outputStyle: "compressed",
      })
    )
    .on("error", console.error.bind(console))
    .pipe(autoprefixer())
    .pipe(write(mapURL))
    .pipe(dest(styleURL))
    .pipe(browserSync.stream());
  done();
}

function js(done) {
  browserify({
    entries: [jsSRC],
  })
    .transform(babelify, { presets: ["@babel/preset-env"] })
    .bundle()
    .pipe(source("script.js"))
    .pipe(buffer())
    .pipe(gulpif(has("production"), stripDebug()))
    .pipe(init({ loadMaps: true }))
    .pipe(uglify())
    .pipe(write("."))
    .pipe(dest(jsURL))
    .pipe(browserSync.stream());
  done();
}

function triggerPlumber(src, url) {
  return _src(src).pipe(plumber()).pipe(dest(url));
}

function watch_files() {
  watch(phpWatch, reload);
  watch(styleWatch, style);
  watch(jsWatch, series(js, reload));
  src(jsURL + "script.js").pipe(
    notify({ message: "Gulp is Watching, Happy Coding!" })
  );
}

task("style", style);
task("js", js);
task("default", parallel(style, js));
task("watch", series(watch_files, browser_sync));
