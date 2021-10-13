<?php

namespace App\Http\Controllers\Home;

use App\Repositories\Artist\ArtistEloquentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArtistController extends Controller
{
    protected $_artistRepository;

    public function __construct(ArtistEloquentRepository $artistRepository)
    {
        $this->_artistRepository = $artistRepository;
    }

    public function index()
    {
        $data['title_page'] = trans('home_artist.title_page');
        $data['featured_artists'] = $this->_artistRepository->getFeaturedArtists();
        $data['artists'] = $this->_artistRepository->getAllArtistExceptsFeatured();

        return view('home.artists', $data);
    }

    public function show($id)
    {
        $artist = $this->_artistRepository->find($id);
        if ($artist) {
            $data['title_page'] = $artist->name;
            $data['artist'] = $artist;
            $data['similarArtists'] = $this->_artistRepository->getSimilarArtists($id);

            return view('home.artist_detail', $data);
        }

        return redirect()->route('home');
    }
}
