<?php
namespace App\Repositories\Permission;

use App\Models\Permission;
use App\Repositories\EloquentRepository;

class PermissionEloquentRepository extends EloquentRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Permission::class;
    }
}
