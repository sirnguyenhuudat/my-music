<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'track_id',
        'album_id',
        'content',
        'user_id',
        'status',
    ];

    public function album()
    {
        return $this->belongsTo('App\Models\Album');
    }

    public function track()
    {
        return $this->belongsTo('App\Models\Track');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
