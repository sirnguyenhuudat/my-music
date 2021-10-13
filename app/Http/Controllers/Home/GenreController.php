<?php

namespace App\Http\Controllers\Home;

use App\Repositories\Genre\GenreEloquentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GenreController extends Controller
{
    protected $_genreRepository;

    public function __construct(GenreEloquentRepository $genreRepository)
    {
        $this->_genreRepository = $genreRepository;
    }

    public function index()
    {
        $data['title_page']  = trans('home_genre.title_page');
        $data['genres'] = $this->_genreRepository->getAll();

        return view('home.genre', $data);
    }

    public function detail($id)
    {
        $genre = $this->_genreRepository->find($id);
        if ($genre) {
            $data['title_page']  = $genre->name;
            $data['genre'] = $genre;
            $data['tracks'] = $this->_genreRepository->getTracksByGenreId($genre->id);

            return view('home.genre_detail', $data);
        } else {
            return redirect()->route('home');
        }
    }
}
