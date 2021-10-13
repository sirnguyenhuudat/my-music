<?php

namespace App\Http\Controllers\Home;

use App\Repositories\Track\TrackEloquentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QueueController extends Controller
{
    protected $_trackRepository, $_artistRepository;

    public function __construct()
    {
        $this->setTrackRepositoty();
    }

    public function setTrackRepositoty()
    {
        $this->_trackRepository = new TrackEloquentRepository();
    }

    public function getQueueTracksByAjax(Request $request)
    {
        if ($request->ajax() && $request->cookie('trackInQueue') != false) {
            $trackInQueue = json_decode($request->cookie('trackInQueue'), true);
            if ($request->cookie('trackCurrent') != false) {
                $trackCurrent = json_decode($request->cookie('trackCurrent'), true);
                $dataTmp = $trackInQueue;
                array_unshift($dataTmp, $trackCurrent);

                return response()->json($dataTmp)->cookie('trackInQueue', json_encode($trackInQueue));
            } else {
                return response()->json($trackInQueue)->cookie('trackInQueue', json_encode($trackInQueue));
            }
        }
    }

    public function addTrackToQueue(Request $request, $id)
    {
        $track = $this->_trackRepository->find($id);
        if ($request->ajax() && $track) {
            if ($request->cookie('trackInQueue') != false) {
                $trackInQueue = json_decode($request->cookie('trackInQueue'), true);
                $trackInQueue[] = [
                    'name' => $track->name,
                    'artist' => $track->artist->name,
                    'path' => convertURL($track->path),
                    'picture' => $track->artist->avatar == '' ? getThumbName(config('image.icon') . 'artist.png') : getThumbName($track->artist->avatar),
                ];
            } else {
                $trackInQueue[] = [
                    'name' => $track->name,
                    'artist' => $track->artist->name,
                    'path' => convertURL($track->path),
                    'picture' => $track->artist->avatar == '' ? getThumbName(config('image.icon') . 'artist.png') : getThumbName($track->artist->avatar),
                ];
            }
            $data = [
                'name' => $track->name,
                'artist' => $track->artist->name,
                'path' => convertURL($track->path),
                'picture' => $track->artist->avatar == '' ? getThumbName(config('image.icon') . 'artist.png') : getThumbName($track->artist->avatar),
                'length' => count($trackInQueue) + 1,
            ];

            return response()->json($data)->cookie('trackInQueue', json_encode($trackInQueue));
        }
    }

    public function destroy(Request $request)
    {
        return back()->cookie('trackInQueue', '', -1)->cookie('trackCurrent', '', -1);
    }

    public function delete(Request $request, $name)
    {
        $trackInQueue = [];
        $trackCurrent = [];
        if ($request->cookie('trackInQueue') != false) {
            $trackInQueue = json_decode($request->cookie('trackInQueue'), true);
            foreach ($trackInQueue as $keyQue => $valQue) {
                if ($valQue['name']  == $name) {
                    unset($trackInQueue[$keyQue]);
                    break;
                }
            }

        }
        if ($request->cookie('trackCurrent') != false) {
            $trackCurrent = json_decode($request->cookie('trackCurrent'), true);
            if ($trackCurrent['name']  == $name) {
                $trackCurrent = [];
            }
        }
        $data = array_merge([$trackCurrent], $trackInQueue);
        if (count($trackCurrent) == 0) {
            return response()->json($trackInQueue)->cookie('trackInQueue', json_encode($trackInQueue))->cookie('trackCurrent', '', -1);
        }
        if (count($trackInQueue) == 0) {
            return response()->json([$trackCurrent])->cookie('trackInQueue', '', -1)->cookie('trackCurrent', json_encode($trackCurrent));
        }

        return response()->json($data)->cookie('trackInQueue', json_encode($trackInQueue))->cookie('trackCurrent', json_encode($trackCurrent));
    }
}
