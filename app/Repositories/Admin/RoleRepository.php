<?php

namespace App\Repositories\Admin;

use App\Exceptions\RepositoryException;
use Exception;
use Spatie\Permission\Models\Role;

class RoleRepository extends BaseRepository
{
    /**
     * get instance Role Model.
     *
     * @return Spatie\Permission\Models\Role
     */
    public function getModel()
    {
        return new Role();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $data Attributes
     *
     * @return Spatie\Permission\Models\Role
     */
    public function create(array $data): Role
    {
        try {
            $permissions = $data['permissions'] ?? [];
            unset($data['permissions']);
            $role = parent::create($data);
            $role->syncPermissions($permissions);

            return $role;
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int|Spatie\Permission\Models\Role $role
     * @param array                             $data Attributes
     *
     * @return Spatie\Permission\Models\Role
     */
    public function update($role, array $data): Role
    {
        try {
            $permissions = $data['permissions'] ?? [];
            unset($data['permissions']);
            $role = parent::update($role, $data);
            $role->syncPermissions($permissions);

            return $role;
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }

    /**
     * Return list of Name's Roles.
     *
     * @return array List of Roles
     */
    public static function list(): array
    {
        return Role::pluck('name', 'name')->all();
    }
}
