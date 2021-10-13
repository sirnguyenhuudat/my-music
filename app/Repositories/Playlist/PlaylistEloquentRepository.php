<?php
namespace App\Repositories\Playlist;

use App\Repositories\EloquentRepository;
use App\Models\Playlist;

class PlaylistEloquentRepository extends EloquentRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Playlist::class;
    }

    public function getPlaylistByMember($user_id)
    {
        return $this->_model->where('user_id', $user_id)->get();
    }
}
