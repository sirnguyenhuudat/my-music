<?php

namespace App\Http\Controllers\Home;

use App\Repositories\Album\AlbumEloquentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class AlbumController extends Controller
{
    //
    protected $_albumRepository;

    public function __construct(AlbumEloquentRepository $albumRepository)
    {
        $this->_albumRepository = $albumRepository;
    }

    public function index($url)
    {
        $data['title_page'] = trans('home_album.title_page');
        $data['featured_albums'] = $this->_albumRepository->getFeaturedAlbums();
        $data['trending_albums'] = $this->_albumRepository->getTrendingAlbums();
        $data['top_15_albums'] = $this->_albumRepository->getTop15Albums();
        $data['release_albums'] = $this->_albumRepository->getRelateAlbums();

        return view('home.album', $data);
    }

    public function detail(Request $request, $id)
    {
        $ip = $request->getClientIp();
        if (Redis::exists($ip . '_album_' . $id)) {
            $tmp = json_decode(Redis::get($ip . '_album_' . $id));
            $data['title_page'] = $tmp->title_page;
            $data['album'] = $tmp->album;

            return view('home.album_detail', $data);
        } else {
            $album = $this->_albumRepository->find($id);
            if ($album) {
                $data['title_page'] = $album->title;
                // insert view album
                $album->views = $album->views + 1;
                $album->week_view = $album->week_view +1;
                $album->month_view = $album->month_view +1;
                $album->save();
                // put data for convenience when get redis cached
                $album->comments = $album->comments->where('status', 1);
                foreach ($album->comments as $key => $comm) {
                    $album->comments[$key]->diffForHumans = $comm->created_at->diffForHumans();
                    $album->comments[$key]->user = $comm->user;
                }
                $tmpArtist = $album->artist;
                $album->artist = $tmpArtist;
                $tmpTracks = $album->tracks;
                $album->tracks = $tmpTracks;
                foreach ($album->tracks as $key => $track) {
                    $album->tracks[$key]->artist = $track->artist;
                }
                $data['album'] = $album;
                Redis::set($ip . '_album_' . $id, json_encode($data), 'EX', 300);

                return view('home.album_detail', $data);
            } else {
                return redirect()->route('home');
            }
        }

    }
}
