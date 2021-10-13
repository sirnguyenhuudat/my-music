<?php
namespace App\Repositories\Track;

use App\Repositories\EloquentRepository;
use App\Models\Track;
use Carbon\Carbon;

class TrackEloquentRepository extends EloquentRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Track::class;
    }

    public function listTrack()
    {
        return $this->_model->orderBy('trending', 'desc')->orderBy('id', 'desc')->get();
    }

    public function getTracksWeekly()
    {
        return $this->_model->orderBy('week_view', 'desc')->limit(config('conf.track_getTracksWeekly_limit'))->get();
    }

    public function getReleaseTracks()
    {
        return $this->_model->orderBy('created_at', 'desc')->limit(config('conf.track_getReleaseTracks_limit'))->get();
    }

    public  function getTracksUploadByMember($id)
    {
        return $this->_model->where('user_id', $id)->orderBy('id', 'desc')->paginate(config('conf.track_getTracksUploadByMember_paginate'));
    }

    public function getTracksByName($trackName)
    {
        return $this->_model->where('name', 'like', '%' . $trackName . '%')->get();
    }

    public function getTracksByArrId(Array $arrTrackId)
    {
        return $this->_model->whereIn('id', $arrTrackId)->get();
    }

    public function getTracksTrending()
    {
        return $this->_model->select(['name', 'id', 'slug'])->where('trending', 1)->get();
    }

    public function getFullTracksTrending()
    {
        return $this->_model->where('trending', 1)->get();
    }

    public function getTracksAdded()
    {
        $tracks = $this->_model->select('id', 'created_at')
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('m'); // grouping by months
            });

        $trackMonthCount = [];
        $trackArr = [];

        foreach ($tracks as $key => $value) {
            $trackMonthCount[(int)$key] = count($value);
        }
        $monthCurrent = date('n');
        for ($i = 1; $i <= 12; $i++) {
            if ($i <= $monthCurrent) {
                if (!empty($trackMonthCount[$i])) {
                    $trackArr[$i] = $trackMonthCount[$i];
                } else {
                    $trackArr[$i] = 0;
                }
            }
        }

        return $trackArr;
    }

    public function getViewsTracks()
    {
        $data['viewsInLastMonth'] = $this->_model->select('id', 'created_at', 'month_view')->sum('view_last_month');
        $data['viewsInMonth'] = $this->_model->select('id', 'created_at', 'month_view')->sum('month_view');

        return $data;
    }

    public function getTotalTracks()
    {
        return $this->_model->select('id')->count();
    }

    public function getDataToDataTables()
    {
        return $this->_model->select('id', 'artist_id', 'author', 'name', 'source', 'trending')->orderBy('trending', 'desc')->orderBy('id', 'desc')->get();
    }
}
