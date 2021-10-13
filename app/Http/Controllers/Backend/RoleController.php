<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\StoreRole;
use App\Http\Requests\UpdateRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Role\RoleEloquentRepository;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    protected $_roleRepository;

    public function __construct(RoleEloquentRepository $roleRepository)
    {
        $this->_roleRepository = $roleRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title_page'] = trans('backend_role.index_title');
        $data['roles'] = $this->_roleRepository->getAll();

        return view('backend.roles.index', $data);
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
    public function store(StoreRole $request)
    {
        $dataInsert = [
            'name' => Str::slug($request->input('name')),
            'display_name' => $request->input('display_name'),
            'description' => $request->input('description'),
        ];
        $role = $this->_roleRepository->create($dataInsert);

        return response()->json([
            'status' => 200,
            'message' => trans('backend_role.created', [
                'slug' => $role->name,
            ]),
            'title' => trans("backend_role.label_success"),
            'role' => $role,
        ]);
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
    public function update(UpdateRole $request, $id)
    {
        $role = $this->_roleRepository->find($id);
        if ($role) {
            $dataUpdate = [
                'name' => Str::slug($request->input('name')),
                'display_name' => $request->input('display_name'),
                'description' => $request->input('description'),
            ];
            $role = $this->_roleRepository->update($id, $dataUpdate);

            return response()->json([
                'status' => 200,
                'message' => trans('backend_role.updated', [
                    'slug' => $role->name,
                ]),
                'title' => trans("backend_role.label_success"),
                'role' => $role,
            ]);
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
        $role = $this->_roleRepository->find($id);
        if ($role && $id != 1) {
            $this->_roleRepository->delete($id);

            return redirect()->route('backend.roles.index')->with('success', trans('backend_role.deleted', [
                'slug' => $role->name,
            ]));
        } else {
            return redirect()->route('backend.roles.index')->with('error', trans('backend_role.error'));
        }
    }
}
