<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\Permission\PermissionEloquentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    protected $_permissionRepo;

    public function __construct(PermissionEloquentRepository $permissionRepo)
    {
        $this->_permissionRepo = $permissionRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title_page'] = trans('backend_permission.index_title');
        $data['permissions'] = $this->_permissionRepo->getAll();

        return view('backend.permissions.index', $data);
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
        $dataInsert = [
            'name' => Str::slug($request->input('name')),
            'display_name' => $request->input('display_name'),
            'description' => $request->input('description'),
        ];
        $permission = $this->_permissionRepo->create($dataInsert);

        return response()->json([
            'status' => 200,
            'message' => trans('backend_permission.created', [
                'slug' => $permission->name,
            ]),
            'title' => trans("backend_permission.label_success"),
            'permission' => $permission,
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
    public function update(Request $request, $id)
    {
        $permission = $this->_permissionRepo->find($id);
        if ($permission) {
            $dataUpdate = [
                'name' => Str::slug($request->input('name')),
                'display_name' => $request->input('display_name'),
                'description' => $request->input('description'),
            ];
            $permission = $this->_permissionRepo->update($id, $dataUpdate);

            return response()->json([
                'status' => 200,
                'message' => trans('backend_permission.updated', [
                    'slug' => $permission->name,
                ]),
                'title' => trans("backend_permission.label_success"),
                'permission' => $permission,
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
        $permission = $this->_permissionRepo->find($id);
        if ($permission) {
            $this->_permissionRepo->delete($id);

            return redirect()->route('backend.permissions.index')->with('success', trans('backend_permission.deleted', [
                'slug' => $permission->name,
            ]));
        } else {
            return redirect()->route('backend.permissions.index')->with('error', trans('backend_permission.error'));
        }
    }
}
