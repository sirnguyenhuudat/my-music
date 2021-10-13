<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'picture',
        'relate_date',
        'info',
        'genre_id',
        'artist_id',
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

    public function tracks()
    {
        return $this->belongsToMany('App\Models\Track', 'album_tracks', 'album_id', 'track_id')->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function genre()
    {
        return $this->belongsTo('App\Models\Genre');
    }
}
