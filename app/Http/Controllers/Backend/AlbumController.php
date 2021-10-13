<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\StoreAlbum;
use App\Http\Requests\UpdateAlbum;
use App\Repositories\Album\AlbumEloquentRepository;
use App\Repositories\Artist\ArtistEloquentRepository;
use App\Repositories\Genre\GenreEloquentRepository;
use App\Repositories\Track\TrackEloquentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class AlbumController extends Controller
{
    protected $_trackRepository, $_genreRepository, $_artistRepository, $_albumRepository;

    public function __construct ()
    {
        $artistRepository = new ArtistEloquentRepository();
        $genreRepository = new GenreEloquentRepository();
        $trackRepository = new TrackEloquentRepository();
        $albumRepository = new AlbumEloquentRepository();
        $this->setArtistRepository($artistRepository);
        $this->setGenreRepository($genreRepository);
        $this->setTrackRepository($trackRepository);
        $this->setAlbumRepository($albumRepository);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title_page'] = trans('backend_album.index_title');
        $data['albums'] = $this->_albumRepository->listAlbum();

        return view('backend.albums.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title_page'] = trans('backend_album.create_title');
        $data['genres'] = $this->_genreRepository->orderBy('name');
        $data['artists'] = $this->_artistRepository->orderBy('name');
        $data['tracks'] = $this->_trackRepository->orderBy('name');

        return view('backend.albums.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAlbum $request)
    {
        $dataInsert = [
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'relate_date' => $request->input('relate_date'),
            'info' => $request->input('info'),
            'genre_id' => $request->input('genre_id'),
            'artist_id' => $request->input('artist_id'),
        ];
        if ($request->hasFile('picture')) {
            $dataInsert['picture'] = createImageAndThumb($request, 'picture', 'albums');
        }
        $album = $this->_albumRepository->create($dataInsert);
        $track_id = $request->input('tracks');
        $album->tracks()->sync($track_id);

        return redirect()->route('backend.albums.index')->with('success', trans('backend_album.created', [
            'name' => $album->name,
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $album = $this->_albumRepository->find($id);
        if ($album) {
            $data['title_page'] = trans('backend_album.update_title', [
                'title' => $album->title,
            ]);
            $data['album'] = $album;
            $data['genres'] = $this->_genreRepository->orderBy('name');
            $data['tracks'] = $this->_trackRepository->orderBy('name');
            $data['artists'] = $this->_artistRepository->orderBy('name');

            return view('backend.albums.edit', $data);
        } else {
            return redirect()->route('backend.albums.index')->with('error', trans('backend_album.error'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAlbum $request, $id)
    {
        $album = $this->_albumRepository->find($id);
        if ($album) {
            $dataUpdate = [
                'title' => $request->input('title'),
                'slug' => Str::slug($request->input('title')),
                'relate_date' => $request->input('relate_date'),
                'info' => $request->input('info'),
                'genre_id' => $request->input('genre_id'),
                'artist_id' => $request->input('artist_id'),
            ];
            if ($request->hasFile('picture')) {
                removeImageAndThumb($album->picture);
                $dataUpdate['picture'] = createImageAndThumb($request, 'picture', 'albums');
            }
            $this->_albumRepository->update($id, $dataUpdate);
            $tracks_id= $request->input('tracks');
            $album->tracks()->sync($tracks_id);

            return redirect()->route('backend.albums.index')->with('success', trans('backend_album.updated', [
                'title' => $dataUpdate['title'],
            ]));
        } else {
            return redirect()->route('backend.albums.index')->with('error', trans('backend_album.error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album = $this->_albumRepository->find($id);
        if ($album) {
            if ($album->picture != '') {
                removeImageAndThumb($album->picture);
            }
            $this->_albumRepository->delete($id);

            return redirect()->route('backend.albums.index')->with('success', trans('backend_album.deleted', [
                'title' => $album->title,
            ]));
        } else {
            return redirect()->route('backend.albums.index')->with('error', trans('backend_album.error'));
        }
    }

    public function setFeatured(Request $request, $id)
    {
        if ($request->ajax()) {
            $album = $this->_albumRepository->find($id);
            if ($album) {
                $album->featured = !$album->featured;
                $album->save();

                return response()->json([
                    'success' => trans('backend_album.featured_success', ['album_title' => $album->title,]),
                    'featured' => $album->featured,
                ]);
            }
        }
    }

    public function setGenreRepository(GenreEloquentRepository $_genreRepository)
    {
        $this->_genreRepository = $_genreRepository;
    }

    public function setArtistRepository(ArtistEloquentRepository $_artistRepository)
    {
        $this->_artistRepository = $_artistRepository;
    }

    public function setTrackRepository(TrackEloquentRepository $_trackRepository)
    {
        $this->_trackRepository = $_trackRepository;
    }

    public function setAlbumRepository(AlbumEloquentRepository $_albumRepository)
    {
        $this->_albumRepository = $_albumRepository;
    }
}
