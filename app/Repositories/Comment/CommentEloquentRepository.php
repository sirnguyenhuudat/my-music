<?php
namespace App\Repositories\Comment;

use App\Repositories\EloquentRepository;
use App\Models\Comment;

class CommentEloquentRepository extends EloquentRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Comment::class;
    }

    public function getListCommentUnpublish()
    {
        return $this->_model->where('status', 0)->orderBy('id', 'desc')->get();
    }

    public function getCommentInMonth()
    {
        $data['commInTracks'] = $this->_model->select('id', 'created_at')
            ->where('track_id', '!=', null)
            ->where('created_at', 'like', date('Y-m') . '%')
            ->count();
        $data['commInAlbums'] = $this->_model->select('id', 'created_at')
            ->where('album_id', '!=', null)
            ->where('created_at', 'like', date('Y-m') . '%')
            ->count();

        return $data;
    }
}
