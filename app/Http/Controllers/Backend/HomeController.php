<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\Album\AlbumEloquentRepository;
use App\Repositories\Comment\CommentEloquentRepository;
use App\Repositories\Track\TrackEloquentRepository;
use App\Repositories\User\UserEloquentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    protected $_trackRepository, $_albumRepository, $_userRepository, $_commentRepository;

    public function __construct()
    {
        $this->setTrackRepository();
        $this->setAlbumRepository();
        $this->setUserRepository();
        $this->setCommentRepository();
    }

    public function setTrackRepository()
    {
        $this->_trackRepository = new TrackEloquentRepository();
    }

    public function setAlbumRepository()
    {
        $this->_albumRepository = new AlbumEloquentRepository();
    }

    public function setUserRepository()
    {
        $this->_userRepository = new UserEloquentRepository();
    }

    public function setCommentRepository()
    {
        $this->_commentRepository = new CommentEloquentRepository();
    }

    public function index()
    {
        $data['title_page'] = trans('backend_statical.title_page');
        $data['memberRegister'] = $this->_userRepository->getNumberMemberReg();
        $data['tracksAdded'] = $this->_trackRepository->getTracksAdded();
        $data['comments'] = $this->_commentRepository->getCommentInMonth();
        $data['viewsInTracks'] = $this->_trackRepository->getViewsTracks();
        $data['viewsInAlbums'] = $this->_albumRepository->getViewsAlbums();
        $data['totalUsers'] = $this->_userRepository->getTotalUsers();
        $data['totalTracks'] = $this->_trackRepository->getTotalTracks();

        return view('backend.statical', $data);
    }
}
