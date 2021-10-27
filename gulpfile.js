const {src, dest, watch} = require('gulp'),
  sass = require('gulp-sass')(require('sass')),
  sourcemaps = require('gulp-sourcemaps'),
  autoPrefixer = require('autoprefixer'),
  postcss = require('gulp-postcss'),
  plumber = require('gulp-plumber'),
  cssNano = require('cssnano'),
  env = require('./.env.js');

const css = async function () {
  return src('assets/styles/dashifen-2022.scss')
    .pipe(plumber())
    .pipe(sourcemaps.init())
    .pipe(sass())
    //.pipe(postcss([autoPrefixer(), cssNano()]))
    .pipe(sourcemaps.write(''))
    .pipe(dest('assets/'));
};

const watcher = async function () {
  await css();
  watch('assets/styles/**/*.scss', css);
};

exports.css = css;
exports.build = css;
exports.watch = watcher;
