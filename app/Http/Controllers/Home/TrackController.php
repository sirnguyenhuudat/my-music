<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\UploadTrack;
use App\Repositories\Artist\ArtistEloquentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Track\TrackEloquentRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;

class TrackController extends Controller
{
    protected $_trackRepository, $_artistRepository;

    public function __construct()
    {
        $this->setTrackRepositoty();
        $this->setArtistRepositoty();
    }

    public function setTrackRepositoty()
    {
        $this->_trackRepository = new TrackEloquentRepository();
    }

    public function setArtistRepositoty()
    {
        $this->_artistRepository = new ArtistEloquentRepository();
    }

    public function getTrackByAjax(Request $request, $id)
    {
        if ($request->ajax()) {
            $track = $this->_trackRepository->find($id);
            if ($track) {
                $data = [
                    'name' => $track->name,
                    'artist' => $track->artist->name,
                    'path' => convertURL($track->path),
                ];
                if ($track->artist->avatar == '') {
                    $data['picture'] = getThumbName(config('image.icon') . 'artist.png');
                } else {
                    $data['picture'] = getThumbName($track->artist->avatar);
                }
                if ($request->cookie('trackInQueue') != false) {
                    $tracksInQueue = json_decode($request->cookie('trackInQueue'), true);
                    $trackCurrent[] = $data;
                    $tracks = array_merge([$data], $tracksInQueue);
                } else {
                    $tracks[] = $data;
                }

                return response()->json($tracks)->cookie('trackCurrent', json_encode($data), time() + 3600);
            }
        }
    }

    public function index(Request $request, $id)
    {
        if ($request->ajax()) {
            $track = $this->_trackRepository->find($id);
            if ($track) {
                $data = [
                    'image' => $track->artist->avatar != '' ? asset(getThumbName($track->artist->avatar)) : asset(config('bower.home_images') . 'logo.png'),
                    'name_track' => $track->name,
                    'artist_name' => $track->artist->name,
                    'path' => $track->source == 'Music Online' ? url('/') . '/' . $track->path : convertURL($track->path),
                ];

                return response()->json($data);
            }
        } else {
            $ip = $request->getClientIp();
            if (Redis::exists($ip . '_track_' . $id)) {
                $tmp = json_decode(Redis::get($ip . '_track_' . $id));
                $data['title_page'] = $tmp->title_page;
                $data['track'] = $tmp->track;

                return view('home.track', $data);
            } else{
                $track = $this->_trackRepository->find($id);
                if ($track) {
                    $data['title_page'] = $track->name;
                    if ($request->cookie('arrTrackId') != false) {
                        $arrTrackId = json_decode($request->cookie('arrTrackId'), true);
                        if (!in_array($id, $arrTrackId)) {
                            array_unshift($arrTrackId, $id);
                            if (count($arrTrackId) > config('conf.track_index_numberTrackRecently')) {
                                array_pop($arrTrackId);
                            }
                        }
                    } else {
                        $arrTrackId = [$id];
                    }
                    // insert view
                    $track->views = $track->views + 1;
                    $track->week_view = $track->week_view +1;
                    $track->month_view = $track->month_view +1;
                    $track->save();
                    // put data for convenience when get redis cached
                    $track->comments = $track->comments->where('status', 1);
                    foreach ($track->comments as $key => $comm) {
                        $track->comments[$key]->diffForHumans = $comm->created_at->diffForHumans();
                        $track->comments[$key]->user = $comm->user;
                    }
                    $tmpArtist = $track->artist;
                    $track->artist = $tmpArtist;
                    $data['track'] = $track;
                    Redis::set($ip . '_track_' . $id, json_encode($data), 'EX', 300);

                    return response()->view('home.track', $data)->cookie('arrTrackId', json_encode($arrTrackId));
                } else {
                    return redirect()->route('home');
                }
            }
        }
    }

    public function upload()
    {
        if (Auth::user()) {
            $data['title_page'] = trans('home_track.upload');
            $data['artists'] = $this->_artistRepository->orderBy('name', 'asc');

            return view('home.upload', $data);
        } else {
            return redirect()->route('home');
        }
    }

    public function uploadTrack(UploadTrack $request)
    {
        if (Auth::user()) {
            $dataInsert = [
                'name' => $request->input('name'),
                'slug' => Str::slug($request->input('name')),
                'user_id' => Auth::id(),
                'author' => $request->input('author'),
                'source' => trans('home_track.music-online'),
                'artist_id' => $request->input('artist_id'),
                'lyric' => trans('home_track.updating'),
            ];
            $dir = 'uploads/' . date('Y-m');
            $dataInsert['path'] = $dir . '/' .saveAudio($dir, $request->file('file'));
            $track = $this->_trackRepository->create($dataInsert);

            return redirect()->route('track.uploaded')->with('success', trans('home_track.upload_success', ['name' => $track->name,]));
        } else {
            return redirect()->route('home');
        }
    }

    public function uploaded()
    {
        if (Auth::user()) {
            $data['title_page'] = trans('home_track.uploaded');
            $data['tracks'] = $this->_trackRepository->getTracksUploadByMember(Auth::id());

            return view('home.uploaded', $data);
        } else {
            return redirect()->route('home');
        }
    }

    public function getTrackCurrent(Request $request)
    {
        if ($request->ajax() && $request->cookie('trackCurrent') != false) {
            $trackCurrent[] = json_decode($request->cookie('trackCurrent'), true);
            if ($request->cookie('trackInQueue') != false) {
                $trackInQueue = json_decode($request->cookie('trackInQueue'), true);
                $trackCurrent = array_merge($trackCurrent, $trackInQueue);
            }
            return response()->json($trackCurrent);
        }
    }
}
