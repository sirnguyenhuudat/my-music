<?php
namespace App\Repositories\Album;

use App\Repositories\EloquentRepository;
use App\Models\Album;

class AlbumEloquentRepository extends EloquentRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Album::class;
    }

    public function getFeaturedAlbums()
    {
        return $this->_model->orderBy('featured', 'desc')->limit(config('conf.album_getFeaturedAlbums_limit'))->get();
    }

    public function getTrendingAlbums()
    {
        return $this->_model->orderBy('week_view', 'desc')->limit(config('conf.album_getTrendingAlbums_limit'))->get();
    }

    public function getTop15Albums()
    {
        return $this->_model->orderBy('views', 'desc')->limit(config('conf.album_getTop15Albums_limit'))->get();
    }

    public function getRelateAlbums()
    {
        return $this->_model->orderBy('relate_date', 'desc')->limit(config('conf.album_getRelateAlbums_limit'))->get();
    }

    public function getAlbumsByTitle($albumTitle)
    {
        return $this->_model->where('title', 'like', '%' . $albumTitle . '%')->get();
    }

    public function getAlbumTopInMonth()
    {
        return $this->_model->orderBy('month_view', 'desc')->limit(config('conf.album_getAlbumTopInMonth_limit'))->first();
    }

    public function listAlbum()
    {
        return $this->_model->orderBy('featured', 'desc')->orderBy('id', 'desc')->get();
    }

    public function getViewsAlbums()
    {
        $data['viewsInLastMonth'] = $this->_model->select('id', 'created_at', 'month_view')->sum('view_last_month');
        $data['viewsInMonth'] = $this->_model->select('id', 'created_at', 'month_view')->sum('month_view');

        return $data;
    }
}
