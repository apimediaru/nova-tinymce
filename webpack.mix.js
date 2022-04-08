const mix = require('laravel-mix');

require('./nova-mix-extension');

mix
  .setPublicPath('dist')
  .js('resources/js/field.js', 'js')
  .vue({ version: 3 })
  .sass('resources/sass/field.scss', 'css')
  .nova('apimediaru/nova-tinymce');
