const mix = require('laravel-mix');
const path = require('path');

require('./nova-mix-extension');

mix
  .setPublicPath('dist')
  .alias({ '@': path.join(__dirname, 'resources/js/') })
  .js('resources/js/field.js', 'js')
  .vue({ version: 3 })
  .sass('resources/sass/field.scss', 'css')
  .nova('apimediaru/nova-tinymce');

mix
  .copyDirectory('resources/js/langs', 'public/langs')
  .copyDirectory('node_modules/tinymce/plugins', 'public/plugins')
  .copyDirectory('node_modules/tinymce/skins', 'public/skins');
