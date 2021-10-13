<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = [
        'name',
        'description',
        'picture',
        'slug',
    ];

    public function artists()
    {
        return $this->belongsToMany('App\Models\Artist', 'artist_genres', 'genre_id', 'artist_id')->withTimestamps();
    }

    public function tracks()
    {
        return $this->belongsToMany('App\Models\Track', 'genre_tracks', 'genre_id', 'track_id')->withTimestamps();
    }

    public function albums()
    {
        return $this->hasMany('App\Models\Album');
    }
}
