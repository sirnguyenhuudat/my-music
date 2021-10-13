const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

mix.js([
    'resources/assets/js/frontend/templates/login.js',
], 'public/js/frontend/login.js');

mix.copy([
    'resources/assets/js/backend/tracks/track.js',
], 'public/js/backend/backend.js');

mix.copy([
    'resources/assets/js/backend/roles/role.js',
], 'public/js/backend/role.js');

mix.copy([
    'resources/assets/js/backend/permissions/permission.js',
], 'public/js/backend/permission.js');

mix.copy([
    'resources/assets/js/backend/access/access.js',
], 'public/js/backend/access.js');

mix.copy([
    'resources/assets/js/backend/access/role.js',
], 'public/js/backend/access_role.js');

mix.copy([
    'resources/assets/js/backend/access/permission.js',
], 'public/js/backend/access_permission.js');

mix.copy([
    'resources/assets/css/backend/access/access.css',
], 'public/css/backend/access.css');

mix.js([
    'resources/assets/js/frontend/templates/register.js',
], 'public/js/frontend/register.js');

mix.js([
    'resources/assets/js/frontend/settings/birthday.js',
], 'public/js/frontend/birthday.js');

mix.styles([
    'resources/assets/css/frontend/profiles/profile.css',
], 'public/css/frontend/profile.css');

mix.styles([
    'resources/assets/css/frontend/playlist_details/playlist_detail.css',
], 'public/css/frontend/playlist_detail.css');

mix.js([
    'resources/assets/js/frontend/playlists/playlist.js',
], 'public/js/frontend/playlist.js')
    .styles([
    'resources/assets/css/frontend/playlists/playlist.css',
], 'public/css/frontend/playlist.css');

mix.styles([
    'resources/assets/css/frontend/indexs/index.css',
], 'public/css/frontend/index.css');

mix.styles([
    'resources/assets/css/frontend/genre_details/genre_detail.css',
], 'public/css/frontend/genre_detail.css');

mix.styles([
    'resources/assets/css/frontend/artist_details/artist_detail.css',
], 'public/css/frontend/artist_detail.css');

mix.styles([
    'resources/assets/css/frontend/album_details/album_detail.css',
], 'public/css/frontend/album_detail.css');

mix.styles([
    'resources/assets/css/frontend/trendings/trending.css',
], 'public/css/frontend/trending.css');

mix.styles([
    'resources/assets/css/frontend/tracks/track.css',
], 'public/css/frontend/track.css');

mix.copy([
    'resources/assets/js/frontend/tracks/track.js',
], 'public/js/frontend/track.js');

mix.copy([
    'resources/assets/js/frontend/audio/jwplay.js',
], 'public/js/frontend/jwplay.js');
