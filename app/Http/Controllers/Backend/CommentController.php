<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\Comment\CommentEloquentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    protected $_commentRepository;

    public function __construct(CommentEloquentRepository $commentRepository)
    {
        $this->_commentRepository = $commentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title_page'] = trans('backend_comment.index_title');
        $data['comments'] = $this->_commentRepository->getListCommentUnpublish();

        return view('backend.comments.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comment = $this->_commentRepository->find($id);
        if ($comment) {
            $dataUpdate = [
                'status' => $request->input('status'),
            ];
            $this->_commentRepository->update($id, $dataUpdate);

            return redirect()->route('backend.comments.index')->with('success', trans('backend_comment.updated', [
                'label' => $comment->user->email,
            ]));
        } else {
            return redirect()->route('backend.comments.index')->with('error', trans('backend_comment.error'));
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
        $comment = $this->_commentRepository->find($id);
        if ($comment) {
            $this->_commentRepository->delete($id);

            return redirect()->route('backend.comments.index')->with('success', trans('backend_comment.deleted'));
        } else {
            return redirect()->route('backend.comments.index')->with('error', trans('backend_comment.error'));
        }
    }
}
