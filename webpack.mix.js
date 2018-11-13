const { mix } = require('laravel-mix');
require('laravel-mix-merge-manifest');

mix.setPublicPath('../../public').mergeManifest();

mix.js(__dirname + '/Resources/assets/js/leopardus-docs.js', 'js/docs.js')
    .sass( __dirname + '/Resources/assets/sass/leopardus-docs.scss', 'css/docs.css');

if (mix.inProduction()) {
    mix.version();
}