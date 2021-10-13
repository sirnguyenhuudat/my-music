<?php
namespace App\Repositories\Role;

use App\Repositories\EloquentRepository;
use App\Models\Role;

class RoleEloquentRepository extends EloquentRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Role::class;
    }
}
