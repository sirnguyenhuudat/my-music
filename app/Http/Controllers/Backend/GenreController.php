<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\StoreGenre;
use App\Http\Requests\UpdateGenre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Repositories\Genre\GenreEloquentRepository;

class GenreController extends Controller
{
    protected $_genreRepository;

    public function __construct(GenreEloquentRepository $genreRepository)
    {
        $this->_genreRepository = $genreRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title_page'] = trans('backend_genre.index_title');
        $data['genres'] = $this->_genreRepository->getAll();

        return view('backend.genres.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title_page'] = trans('backend_genre.create_title');

        return view('backend.genres.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGenre $request)
    {
        $dataInsert = [
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            'description' => $request->input('description'),
            'picture' => null,
        ];
        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $dir = 'uploads/genres/';
            $fileName = saveImage($dir, $file);
            createThumb($dir, $fileName);
            createThumb($dir, $fileName, 250, 250);
            $dataInsert['picture'] = $dir . '/' . $fileName;
        }
        $genre = $this->_genreRepository->create($dataInsert);

        return redirect()->route('backend.genres.index')->with('success', trans('backend_genre.created', [
            'name' => $genre->name,
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
        $genre = $this->_genreRepository->find($id);
        if ($genre) {
            $data['title_page'] = trans('backend_genre.update_title', [
                'name' => $genre->name,
            ]);
            $data['genre'] = $genre;

            return view('backend.genres.edit', $data);
        } else {
            return redirect()->route('backend.genres.index')->with('error', trans('backend_genre.error'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGenre $request, $id)
    {
        $genre = $this->_genreRepository->find($id);
        if ($genre) {
            $dataUpdate = [
                'name' => $request->input('name'),
                'slug' => Str::slug($request->input('name')),
                'description' => $request->input('description'),
            ];
            if ($request->hasFile('picture')) {
                if (file_exists($genre->picture) != '') {
                    unlink($genre->picture);
                    unlink(getThumbName($genre->picture));
                    unlink(getThumbName($genre->picture, 250, 250));
                }
                $file = $request->file('picture');
                $dir = 'uploads/genres/';
                $fileName = saveImage($dir, $file);
                createThumb($dir, $fileName);
                createThumb($dir, $fileName, 250, 250);
                $dataUpdate['picture'] = $dir . '/' . $fileName;
            }
            $this->_genreRepository->update($id, $dataUpdate);

            return redirect()->route('backend.genres.index')->with('success', trans('backend_genre.updated', [
                'name' => $dataUpdate['name'],
            ]));
        } else {
            return redirect()->route('backend.genres.index')->with('error', trans('backend_genre.error'));
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
        $genre = $this->_genreRepository->find($id);
        if ($genre) {
            if ($genre->picture != '') {
                if (file_exists($genre->picture)) {
                    unlink($genre->picture);
                    unlink(getThumbName($genre->picture));
                    unlink(getThumbName($genre->picture, 250, 250));
                }
            }
            $this->_genreRepository->delete($id);

            return redirect()->route('backend.genres.index')->with('success', trans('backend_genre.deleted', [
                'name' => $genre->name,
            ]));
        } else {
            return redirect()->route('backend.genres.index')->with('error', trans('backend_genre.error'));
        }
    }
}
