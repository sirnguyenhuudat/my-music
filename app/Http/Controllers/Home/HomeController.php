<?php

namespace App\Http\Controllers\Home;

use App\Repositories\Album\AlbumEloquentRepository;
use App\Repositories\Artist\ArtistEloquentRepository;
use App\Repositories\Genre\GenreEloquentRepository;
use App\Repositories\Track\TrackEloquentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    protected $_trackRepository, $_genreRepository, $_albumRepository, $_artistRepository;

    public function __construct()
    {
        $this->setTrackRepositoty();
        $this->setGenreRepository();
        $this->setAlbumRepository();
        $this->setArtistRepository();
    }

    public function setTrackRepositoty()
    {
        $this->_trackRepository = new TrackEloquentRepository();
    }

    public function setGenreRepository()
    {
        $this->_genreRepository = new GenreEloquentRepository();
    }

    public function setAlbumRepository()
    {
        $this->_albumRepository = new AlbumEloquentRepository();
    }

    public function setArtistRepository()
    {
        $this->_artistRepository = new ArtistEloquentRepository();
    }

    public function index(Request $request)
    {
        $ip = $request->getClientIp();
        $data = [
            'title_page' => trans('home_index.title'),
            'weekly_top_15' => [],
            'top_genres' => [],
            'featured_albums' => [],
            'featured_artists' => [],
            'release_tracks' => [],
            'album_top_month' => null
        ];

        if (Redis::exists($ip . '_home_page_musiconline')) {
            $tmpData = json_decode(Redis::get($ip . '_home_page_musiconline'));
            $data['title_page'] = $tmpData->title_page;
            $data['weekly_top_15'] = $tmpData->weekly_top_15;
            $data['top_genres'] = $tmpData->top_genres;
            $data['featured_albums'] = $tmpData->featured_albums;
            $data['featured_artists'] = $tmpData->featured_artists;
            $data['release_tracks'] = $tmpData->release_tracks;
            $data['album_top_month'] = $tmpData->album_top_month;
        } else {
            // put data for convenience when get redis cached
            // Weekly
            $weekly_top_15 = $this->_trackRepository->getTracksWeekly();
            foreach ($weekly_top_15 as $key => $track) {
                $weekly_top_15[$key]->aritst = $track->artist;
            }
            // Featured Album
            $featured_albums = $this->_albumRepository->getFeaturedAlbums();
            foreach ($featured_albums as $key => $track) {
                $featured_albums[$key]->aritst = $track->artist;
            }
            // Release Tracks
            $release_tracks = $this->_trackRepository->getReleaseTracks();
            foreach ($release_tracks as $key => $track) {
                $release_tracks[$key]->aritst = $track->artist;
            }
            // Album Top Month
            $album_top_month = $this->_albumRepository->getAlbumTopInMonth();
            if ($album_top_month) {
                $tmpTracks = $album_top_month->tracks;
                $album_top_month->tracks = $tmpTracks;
                $data['weekly_top_15'] = $weekly_top_15;
                $data['top_genres'] = $this->_genreRepository->getTopGenres();
                $data['featured_albums'] = $featured_albums;
                $data['featured_artists'] = $this->_artistRepository->getFeaturedArtists();
                $data['release_tracks'] = $release_tracks;
                $data['album_top_month'] = $album_top_month;
                Redis::set($ip . '_home_page_musiconline', json_encode($data), 'EX', 300);
            }
        }
        if ($request->cookie('arrTrackId') != false) {
            $arrTrackId = json_decode($request->cookie('arrTrackId'), true);
            $data['tracks_recently'] = $this->_trackRepository->getTracksByArrId($arrTrackId);
        }

        return view('home.index', $data);
    }

    public function searchByTrack(Request $request)
    {
        $trackName = $request->input('value');
        $tracks = $this->_trackRepository->getTracksByName($trackName);

        return response()->json($tracks);
    }

    public function searchByAlbum(Request $request)
    {

        $albumTitle = $request->input('value');
        $albums = $this->_albumRepository->getAlbumsByTitle($albumTitle);

        return response()->json($albums);
    }

    public function searchByArtist(Request $request)
    {
        $artistName = $request->input('value');
        $artists = $this->_artistRepository->getArtistsByName($artistName);

        return response()->json($artists);
    }

    public function listTrending()
    {
        $data['title_page'] = trans('home_index.title_trending');
        $data['trending'] = $this->_trackRepository->getFullTracksTrending();

        return view('home.trending', $data);
    }

    public function changeLanguage(Request $request)
    {
        Session::put('website-language', $request->input('language'));

        return redirect()->back();
    }
}
