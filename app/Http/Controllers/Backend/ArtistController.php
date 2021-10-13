<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Repositories\Artist\ArtistEloquentRepository;
use App\Repositories\Genre\GenreEloquentRepository;
use App\Http\Requests\StoreArtist;
use App\Http\Requests\UpdateArtist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    protected $_artistRepository, $_genreRepository;

    public function __construct (ArtistEloquentRepository $artistRepository, GenreEloquentRepository $genreRepository)
    {
        $this->_artistRepository = $artistRepository;
        $this->_genreRepository = $genreRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title_page'] = trans('backend_artist.index_title');
        $data['artists'] = $this->_artistRepository->listArtist();

        return view('backend.artists.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title_page'] = trans('backend_artist.create_title');
        $data['genres'] = $this->_genreRepository->getAll();

        return view('backend.artists.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArtist $request)
    {
        $dataInsert = [
            'name' => $request->input('name'),
            'year_active' => $request->input('year_active'),
            'info' => $request->input('info'),
            'slug' => Str::slug($request->input('name')),
        ];
        if ($request->hasFile('avatar')) {
            $dataInsert['avatar'] = createImageAndThumb($request, 'avatar', 'artists');
        }
        $artist = $this->_artistRepository->create($dataInsert);
        $genres_id = $request->input('genres');
        $artist->genres()->sync($genres_id);

        return redirect()->route('backend.artists.index')->with('success', trans('backend_artist.created', [
            'name' => $artist->name,
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
        $artist = $this->_artistRepository->find($id);
        if ($artist) {
            $data['title_page'] = trans('backend_artist.update_title', [
                'name' => $artist->name,
            ]);
            $data['artist'] = $artist;
            $data['genres'] = $this->_genreRepository->getAll();

            return view('backend.artists.edit', $data);
        } else {
            return redirect()->route('backend.artists.index')->with('error', trans('backend_artist.error'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArtist $request, $id)
    {
        $artist = $this->_artistRepository->find($id);
        if ($artist) {
            $dataUpdate = [
                'name' => $request->input('name'),
                'year_active' => $request->input('year_active'),
                'info' => $request->input('info'),
                'slug' => Str::slug($request->input('name')),
            ];
            if ($request->hasFile('avatar')) {
                removeImageAndThumb($artist->avatar);
                $dataUpdate['avatar'] = createImageAndThumb($request, 'avatar', 'artists');
            }
            $this->_artistRepository->update($id, $dataUpdate);
            $genres_id = $request->input('genres');
            $artist->genres()->sync($genres_id);

            return redirect()->route('backend.artists.index')->with('success', trans('backend_artist.updated', [
                'name' => $dataUpdate['name'],
            ]));
        } else {
            return redirect()->route('backend.artists.index')->with('error', trans('backend_artist.error'));
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
        $artist = $this->_artistRepository->find($id);
        if ($artist) {
            if ($artist->avatar != '') {
                removeImageAndThumb($artist->avatar);
            }
            $this->_artistRepository->delete($id);

            return redirect()->route('backend.artists.index')->with('success', trans('backend_artist.deleted', [
                'name' => $artist->name,
            ]));
        } else {
            return redirect()->route('backend.artists.index')->with('error', trans('backend_artist.error'));
        }
    }

    public function setFeatured(Request $request, $id)
    {
        if ($request->ajax()) {
            $artist = $this->_artistRepository->find($id);
            if ($artist) {
                $artist->featured = !$artist->featured;
                $artist->save();

                return response()->json([
                    'success' => trans('backend_artist.featured_success', ['artist_name' => $artist->name,]),
                    'featured' => $artist->featured,
                ]);
            }

        }
    }
}
