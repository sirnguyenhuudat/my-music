<?php
namespace App\Repositories\Genre;

use App\Repositories\EloquentRepository;
use App\Models\Genre;

class GenreEloquentRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Genre::class;
    }

    public function getTopGenres()
    {
        return $this->_model->orderBy('order', 'desc')->limit(config('conf.genre_getTopGenres_limit'))->get();
    }

    public function getTracksByGenreId($id)
    {
        return $this->_model->select('tracks.id as track_id', 'tracks.name as track_name', 'tracks.slug as track_slug', 'tracks.month_view as month_view', 'artists.name as artist_name')
            ->where('genres.id', $id)
            ->join('genre_tracks', 'genre_tracks.genre_id', '=', 'genres.id')
            ->join('tracks', 'tracks.id', '=', 'genre_tracks.track_id')
            ->join('artists', 'artists.id', '=', 'tracks.artist_id')
            ->paginate(config('conf.genre_getTracksByGenreId_paginate'));
    }
}
