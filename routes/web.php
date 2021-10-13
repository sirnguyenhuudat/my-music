<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Home\HomeController@index');

Route::group([
    'prefix' => '/backend',
    'as' => 'backend.',
    'namespace' => 'Backend',
    'middleware' => 'locale',
], function () {
    Route::get('statical' , 'HomeController@index')->name('statical')->middleware('role:admin');
    Route::resource('genres', 'GenreController')->middleware('role:admin');
    Route::get('artist/featured/{id}', 'ArtistController@setFeatured')->middleware('role:admin');
    Route::resource('artists', 'ArtistController')->middleware('role:admin');
    Route::get('track/trending/{id}', 'TrackController@setTrending')->middleware('role:admin');
    Route::get('tracks/get-datatables', 'TrackController@getTracksFromDatatables')->middleware('role:admin');
    Route::resource('tracks', 'TrackController')->middleware('role:admin');
    Route::get('album/featured/{id}', 'AlbumController@setFeatured')->middleware('role:admin');
    Route::resource('albums', 'AlbumController')->middleware('role:admin');
    Route::resource('comments', 'CommentController')->only([
        'index',
        'update',
        'destroy',
    ])->middleware('role:admin');
    Route::resource('users', 'UserController')->middleware('role:admin');
    Route::resource('roles', 'RoleController')->middleware('role:admin');
    Route::resource('permissions', 'PermissionController')->middleware('role:admin');
    Route::get('access', 'AccessController@index')->middleware('role:admin')->name('access.index');
    Route::post('access/add-permissions', 'AccessController@addPermissionsToRole')->name('access.add.permissions')->middleware('role:admin');
    Route::post('access/add-roles', 'AccessController@addRolesToPermission')->name('access.add.roles')->middleware('role:admin');
    Route::get('/login', 'LoginController@showLoginForm');
});

Route::group([
    'prefix' => '/',
    'namespace' => 'Home',
    'middleware' => 'locale',
], function () {
    // change language
    Route::post('change-language', 'HomeController@changeLanguage')->name('home.change-language');
    // Home page
    Route::get('home', 'HomeController@index')->name('home');
    // Package Typehead search
    Route::get('search/track', 'HomeController@searchByTrack');
    Route::get('search/album', 'HomeController@searchByAlbum');
    Route::get('search/artist', 'HomeController@searchByArtist');
    // Track
    Route::get('track/{id}', 'TrackController@getTrackByAjax')->where('id', '[0-9]+');
    Route::get('track/{id}/{url}', 'TrackController@index')->name('track.index')->where('id', '[0-9]+');
    Route::get('track/current', 'TrackController@getTrackCurrent');
    // Album
    Route::get('albums/{url}', 'AlbumController@index')->name('albums');
    Route::get('album/{id}/{url}', 'AlbumController@detail')->name('album.detail')->where('id', '[0-9]+');
    // Genre
    Route::get('genres/{url}', 'GenreController@index')->name('genres');
    Route::get('genres/{id}/{url}', 'GenreController@detail')->name('genre.detail')->where('id', '[0-9]+');
    // Member
    Route::get('profile/{id}/{url}', 'MemberController@profile')->name('member.profile')->where('id', '[0-9]+');
    Route::get('setting/{id}/{url}', 'MemberController@setting')->name('member.setting')->where('id', '[0-9]+');
    Route::put('setting/{id}', 'MemberController@update')->name('member.update')->where('id', '[0-9]+');
    // Playlist manage
    Route::get('playlist/list-playlist.html', 'PlaylistController@getPlaylistByMember')->name('playlist.get_playlist_by_member');
    Route::post('playlist', 'PlaylistController@store')->name('playlist.store');
    Route::get('playlist/{id}/{url}', 'PlaylistController@show')->name('playlist.show')->where('id', '[0-9]+');
    Route::delete('playlist/{id}', 'PlaylistController@destroy')->name('playlist.destroy')->where('id', '[0-9]+');
    Route::get('playlist/add_track/{playlist_id}/{track_id}', 'PlaylistController@addTrackToPlaylist')->name('playlist.add_track')->where([
        'playlist_id' => '[0-9]+',
        'track_id' => '[0-9]+',
    ]);
    Route::delete('playlist/remove_track/{playlist_id}/{track_id}', 'PlaylistController@removeTrackToPlaylist')->name('playlist.remove_track')->where([
        'playlist_id' => '[0-9]+',
        'track_id' => '[0-9]+',
    ]);
    Route::post('playlist/add_album_to_playlist.html', 'PlaylistController@addAllbumToPlaylist')->name('playlist.add_album');
    // Upload
    Route::get('upload.html', 'TrackController@upload')->name('track.upload');
    Route::post('upload.html', 'TrackController@uploadTrack')->name('track.upload_track');
    Route::get('uploaded.html', 'TrackController@uploaded')->name('track.uploaded');
    // Comment
    Route::post('comment/{type}/{url}', 'CommentController@saveComment')->name('comment.save')->where(['type' => '[a-zA-Z0-9-_]+', 'url' => '[a-zA-Z0-9_-]+.html']);
    // Trending
    Route::get('trending.html', 'HomeController@listTrending')->name('trending');
    // Artist
    Route::get('list-artist.html', 'ArtistController@index')->name('artist.index');
    Route::get('artist/{id}/{url}', 'ArtistController@show')->name('artist.show')->where('id', '[0-9]+');
    // login with socialite
    Route::get('redirect/{social}', 'SocialAuthController@redirect')->name('social.redirect');
    Route::get('callback/{social}', 'SocialAuthController@callback')->name('social.callback');
    // add track to queue
    Route::get('queue/track/{id}', 'QueueController@addTrackToQueue')->where('id', '[0-9]+');
    Route::get('queue/get', 'QueueController@getQueueTracksByAjax');
    Route::delete('queue/destroy', 'QueueController@destroy')->name('queue.destroy');
    Route::get('queue/delete/{name}', 'QueueController@delete');
});

Auth::routes();

