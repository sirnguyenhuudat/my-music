<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\UpdateUser;
use App\Repositories\Role\RoleEloquentRepository;
use App\Repositories\User\UserEloquentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $_userRepository, $_roleRepository;

    public function __construct(UserEloquentRepository $userRepository, RoleEloquentRepository $roleRepository)
    {
        $this->_userRepository = $userRepository;
        $this->_roleRepository = $roleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title_page'] = trans('backend_user.index_title');
        $data['users'] = $this->_userRepository->orderBy('id', 'desc');

        return view('backend.users.index', $data);
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
        $user = $this->_userRepository->find($id);
        if ($user) {
            $data['title_page'] = trans('backend_user.update_title', [
                'name' => $user->name,
            ]);
            $data['user'] = $user;
            $data['roles'] = $this->_roleRepository->getAll();

            return view('backend.users.edit', $data);
        } else {
            return redirect()->route('backend.users.index')->with('error', trans('backend_user.error'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, $id)
    {
        $user = $this->_userRepository->find($id);
        if ($user) {
            $roles_id = $request->input('roles');
            $user->roles()->sync($roles_id);

            return redirect()->route('backend.users.index')->with('success', trans('backend_user.updated', [
                'name' => $user->email,
            ]));
        } else {
            return redirect()->route('backend.users.index')->with('error', trans('backend_user.error'));
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
        $user = $this->_userRepository->find($id);
        if ($user) {
            if ($user->avatar != '') {
                removeImageAndThumb($user->avatar);
            }
            $this->_userRepository->delete($id);

            return redirect()->route('backend.users.index')->with('success', trans('backend_user.deleted', [
                'name' => $user->email,
            ]));
        } else {
            return redirect()->route('backend.users.index')->with('error', trans('backend_user.error'));
        }
    }

}
