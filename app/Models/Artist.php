<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'avatar',
        'year_active',
        'info',
    ];

    public function albums()
    {
        return $this->hasMany('App\Models\Album');
    }

    public function tracks()
    {
        return $this->hasMany('App\Models\Track');
    }

    public function genres()
    {
        return $this->belongsToMany('App\Models\Genre', 'artist_genres', 'artist_id', 'genre_id')->withTimestamps();
    }
}
