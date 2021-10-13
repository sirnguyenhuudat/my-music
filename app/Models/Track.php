<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'author',
        'artist_id',
        'user_id',
        'source',
        'path',
        'lyric',
        'week_view',
        'month_view',
        'views',
        'view_last_week',
        'view_last_month',
    ];

    public function artist()
    {
        return $this->belongsTo('App\Models\Artist');
    }

    public function genres()
    {
        return $this->belongsToMany('App\Models\Genre', 'genre_tracks', 'track_id', 'genre_id')->withTimestamps();
    }

    public function albums()
    {
        return $this->belongsToMany('App\Models\Album', 'album_tracks', 'track_id', 'album_id')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function playlists()
    {
        return $this->belongsToMany('App\Models\Playlist', 'playlist_tracks', 'track_id', 'playlist_id')->withTimestamps();
    }
}
