<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\PersToRoleRequest;
use App\Http\Requests\RolesToPersRequest;
use App\Repositories\Permission\PermissionEloquentRepository;
use App\Repositories\Role\RoleEloquentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccessController extends Controller
{
    protected $_roleRepo, $_permissionRepo;

    public function __construct(RoleEloquentRepository $roleRepo, PermissionEloquentRepository $permissionRepo)
    {
        $this->_roleRepo = $roleRepo;
        $this->_permissionRepo = $permissionRepo;
    }

    public function index()
    {
        $data['title_page'] = trans('backend_access.index_titlepage');
        $data['roles'] = $this->_roleRepo->getAll();
        $data['permissions'] = $this->_permissionRepo->getAll();

        return view('backend.access.index', $data);
    }

    public function addPermissionsToRole(PersToRoleRequest $request)
    {
       $role = $this->_roleRepo->find($request->input('role'));
       $permissions = $request->input('permissions');
       $role->permissions()->sync($permissions);

       return redirect()->route('backend.access.index')->with('success', trans('backend_access.success_add_pers', ['role' => $role->name,]));
    }

    public function addRolesToPermission(RolesToPersRequest $request)
    {
        $permission = $this->_permissionRepo->find($request->input('permission'));
        $roles = $request->input('roles');
        $permission->roles()->sync($roles);

        return redirect()->route('backend.access.index')->with('success', trans('backend_access.success_add_roles', ['permission' => $permission->name,]));
    }
}
