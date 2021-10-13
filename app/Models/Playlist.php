<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'user_id',
    ];

    public function tracks()
    {
        return $this->belongsToMany('App\Models\Track', 'playlist_tracks', 'playlist_id', 'track_id')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
