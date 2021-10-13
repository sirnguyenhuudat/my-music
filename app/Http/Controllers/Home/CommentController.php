<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\StoreComment;
use App\Repositories\Album\AlbumEloquentRepository;
use App\Repositories\Comment\CommentEloquentRepository;
use App\Repositories\Track\TrackEloquentRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    protected $_commentRepository, $_trackRepository, $_albumRepository;

    public function __construct(CommentEloquentRepository $commentRepository, TrackEloquentRepository $trackRepository, AlbumEloquentRepository $albumRepository)
    {
        $this->_commentRepository = $commentRepository;
        $this->_trackRepository = $trackRepository;
        $this->_albumRepository = $albumRepository;
    }

    public function saveComment(StoreComment $request, $type, $url)
    {
        $data = explode('-', $type);
        $id = $data[1];
        $typeComm = $data[0];
        // comment from track
        if ($typeComm === 'track') {
            $track = $this->_trackRepository->find($id);
            if ($track && Auth::user()) {
                $dataInsert = [
                    'track_id' => $id,
                    'content' => $request->input('comment'),
                    'user_id' => Auth::id(),
                ];
                if (Auth::user()->isAdmin()) {
                    $dataInsert['status'] = 1;
                };
                $this->_commentRepository->create($dataInsert);

                return redirect()->route('track.index', ['id' => $id, 'url' => $url,])->with('success', trans('home_track.created_comment_in_track'));
            }
        }
        // comment from album
        if ($typeComm === 'album') {
            $album = $this->_albumRepository->find($id);
            if ($album && Auth::user()) {
                $dataInsert = [
                    'album_id' => $id,
                    'content' => $request->input('comment'),
                    'user_id' => Auth::id(),
                ];
                if (Auth::user()->isAdmin()) {
                    $dataInsert['status'] = 1;
                };
                $this->_commentRepository->create($dataInsert);

                return redirect()->route('album.detail', ['id' => $id, 'url' => $url,])->with('success', trans('home_track.created_comment_in_album'));
            }
        }

        return redirect()->route('home');
    }
}
