const mix = require('laravel-mix');
const lodash = require('lodash');

const folder = {
    src: 'resources/', // source files
    dist: 'public/', // build files
    dist_assets: 'public/assets/', // build assets files
    node_modules: 'node_modules/',
};

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', `${folder.dist_assets}/js`).minify(
    `${folder.dist_assets}/js/app.js`
);
mix.sass('resources/sass/app.scss', `${folder.dist_assets}/css`).minify(
    `${folder.dist_assets}/css/app.css`
);

const patternflyAssets = {
    css: [
        './node_modules/@patternfly/patternfly/patternfly.css',
        './node_modules/@patternfly/patternfly/patternfly-addons.css',
    ],
};

// copying required assets
lodash(patternflyAssets).forEach(function(asset, type) {
    const css = [];
    for (let i = 0; i < asset.length; ++i) {
        css.push(asset[i]);
    }
    mix.combine(css, `${folder.dist_assets}css/vendor-pf4.css`).minify(
        `${folder.dist_assets}css/vendor-pf4.css`
    );
});
mix.js(
    './node_modules/jquery-slimscroll/jquery.slimscroll.js',
    `${folder.dist_assets}js/vendor-slimscroll.js`
).minify(`${folder.dist_assets}js/vendor-slimscroll.js`);

mix.js(
    './node_modules/datatables.net/js/jquery.dataTables.js',
    `${folder.dist_assets}js/vendor-jquery.dataTables.js`
).minify(`${folder.dist_assets}js/vendor-jquery.dataTables.js`);

mix.copyDirectory(
    `${folder.node_modules}@patternfly/patternfly/assets`,
    `${folder.dist_assets}css/assets`
);
