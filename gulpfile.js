'use strict';

// Utility functions
const jsonToList = function (obj) {
    return Object.keys(obj).map(item => `   👉 ${item}`)
        .toString()
        .split(',')
        .join('\n');
};

const color = (log) => {
    return plugins.chalk.white.bold(log);
};

const onError = (err) => {
    plugins.notify.onError({ title: 'JS Error', message: 'Check your terminal', sound: false })(err);
    plugins.fancyLog(color(err.toString()));
    // this.emit('end');
};

// package vars
const pkg = require('./package.json');
const devDep = jsonToList(pkg.devDependencies);
const dep = jsonToList(pkg.dependencies);
const babel = require('rollup-plugin-babel');

// gulp
const gulp = require("gulp");

// load all plugins in "devDependencies" into the variable plugins
const plugins = require("gulp-load-plugins")({
    pattern: ["*"],
    scope: ["devDependencies"],
    // camelize: true,
    rename: {
        // 'gulp-autoprefixer': 'autoprefixer',
        'gulp-clean-css': 'cleancss',
        'gulp-sass': 'sass',
        'gulp-sourcemaps': 'sourcemaps',
        'rollup-stream': 'rollupstream',
        'rollup-plugin-babel': 'babel',
        'vinyl-source-stream': 'source',
        'vinyl-buffer': 'buffer'
    }
});

const banner = ['/**',
' * <%= pkg.name %> - <%= pkg.description %>',
' * @author         <%= pkg.author %>',
" * @build          " + plugins.moment().format("llll") + " ET",
" * @release        " + plugins.gitRevSync.long() + " [" + plugins.gitRevSync.branch() + "]",
" * @copyright      Copyright (c) " + plugins.moment().format("YYYY") + ", <%= pkg.copyright %>",
' * @version        v<%= pkg.version %>',
' * @link           <%= pkg.homepage %>',
// ' * @devDependencies \n'+ devDep +'',
// ' * @dependencies \n'+ dep +'',
' */',
''].join('\n');


gulp.task('sass', function () {
    plugins.fancyLog(color('-> Compiling SASS'));
    return gulp
        .src(pkg.paths.src.scss + "**/*.scss")
        .pipe(plugins.plumber({errorHandler: onError}))
        .pipe(plugins.sourcemaps.init())
        .pipe(plugins.sass()
            .on("error", plugins.sass.logError))
        .pipe(plugins.postcss([ plugins.autoprefixer() ]))
        .pipe(plugins.concat('style.min.css'))
        .pipe(plugins.cleancss({compatibility: 'ie8'}))
        .pipe(plugins.header(banner, {pkg: pkg}))
        .pipe(plugins.sourcemaps.write("./"))
        .pipe(plugins.size({gzip: true, showFiles: true}))
        .pipe(gulp.dest(pkg.paths.dist.css))
});

gulp.task('adminsass', function () {
    plugins.fancyLog(color('-> Compiling SASS'));
    return gulp
        .src(pkg.paths.src.scss + "**/app.admin.scss")
        .pipe(plugins.plumber({errorHandler: onError}))
        .pipe(plugins.sourcemaps.init())
        .pipe(plugins.sass()
            .on("error", plugins.sass.logError))
        .pipe(plugins.postcss([ plugins.autoprefixer() ]))
        .pipe(plugins.concat('admin.style.min.css'))
        .pipe(plugins.cleancss({compatibility: 'ie8'}))
        .pipe(plugins.header(banner, {pkg: pkg}))
        .pipe(plugins.sourcemaps.write("./"))
        .pipe(plugins.size({gzip: true, showFiles: true}))
        .pipe(gulp.dest(pkg.paths.dist.css))
});



// babel js task - transpile our Javascript into the build directory
gulp.task("js", () => {
    plugins.fancyLog(color('-> Building & transpiling JavaScript via Rollup/Babel...'));
    return plugins.rollupstream({
        input: './src/js/app.js',
        sourcemap: true,
        format: 'es',
        plugins: [
            babel({
                presets: ['@babel/env'],
                exclude: 'node_modules/**',
                compact: true,
                comments: false
            })
        ]
    })
    .pipe(plugins.plumber({ errorHandler: onError }))
    .pipe(plugins.source('app.min.js'))
    .pipe(plugins.buffer())
    .pipe(plugins.sourcemaps.init())
    .pipe(plugins.streamify(plugins.uglify({ compress: { drop_debugger: false }, output: { comments: false } })))
    .pipe(plugins.header(banner, { pkg }))
    .pipe(plugins.sourcemaps.write('./', { includeContent: true }))
    .pipe(gulp.dest(pkg.paths.dist.js))
    .pipe(plugins.browserSync.reload({ stream: true }));
});


// babel js task - transpile our Javascript into the build directory
gulp.task("adminjs", () => {
    plugins.fancyLog(color('-> Building & transpiling admin JavaScript via Rollup/Babel...'));
    return plugins.rollupstream({
        input: './src/js/app.admin.js',
        sourcemap: true,
        format: 'es',
        plugins: [
            babel({
                presets: ['@babel/env'],
                exclude: 'node_modules/**',
                compact: true,
                comments: false
            })
        ]
    })
    .pipe(plugins.plumber({ errorHandler: onError }))
    .pipe(plugins.source('app.admin.min.js'))
    .pipe(plugins.buffer())
    .pipe(plugins.sourcemaps.init())
    .pipe(plugins.streamify(plugins.uglify({ compress: { drop_debugger: false }, output: { comments: false } })))
    .pipe(plugins.header(banner, { pkg }))
    .pipe(plugins.sourcemaps.write('./', { includeContent: true }))
    .pipe(gulp.dest(pkg.paths.dist.js))
    .pipe(plugins.browserSync.reload({ stream: true }));
});

// vendors JS bundling
gulp.task('vendors', () => {
    plugins.fancyLog(color('-> Building vendors JS...'));
    return gulp.src(pkg.paths.src.js +'vendors/*.js')
        .pipe(plugins.plumber({errorHandler: onError}))
        .pipe(plugins.concat('vendors.min.js'))
        .pipe(plugins.streamify(plugins.uglify({ compress: { drop_debugger: false }, output: { comments: false } })))
        .pipe(plugins.sourcemaps.write("./"))
        .pipe(plugins.size({gzip: true, showFiles: true}))
        .pipe(gulp.dest(pkg.paths.dist.js))
});

// watch task
gulp.task('watch', () => {
    plugins.fancyLog(color('-> Watching JS/CSS/PHP...'));
    gulp.watch([pkg.paths.src.scss + "**/*.scss"], gulp.series('sass', 'reload'));
    gulp.watch([pkg.paths.src.scss + "**/app.admin.scss"], gulp.series('adminsass', 'reload'));

    gulp.watch([pkg.paths.src.js + "**/*.js"], gulp.series('js', 'reload'));
    // gulp.watch('src/**/*.{js,css}', gulp.series('reload'));
    gulp.watch('./**/*.php', gulp.series('reload'));
});

// webserver task
gulp.task('serve', () => {
    plugins.browserSync.init({
        open: false,
        notify: false,
        proxy: {
            target: pkg.urls.dev
        }
    });
});

gulp.task('reload', done => {
    plugins.browserSync.reload();
    done();
});

gulp.task('default', gulp.parallel('serve', 'watch'));