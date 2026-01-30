<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateSuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('permission:update');

        $superAdmin = User::updateOrCreate(
            [
                'email' => env('SUPER_ADMIN_EMAIL', 'info@artno.ca'),
            ],
            [
                'first_name' => env('SUPER_ADMIN_FIRST_NAME', 'Arto'),
                'last_name' => env('SUPER_ADMIN_LAST_NAME', 'Admin'),
                'can_access_admin' => true,
            ]
        );

        if ($superAdmin) {
            $role = Role::firstOrCreate(['name' => 'Super Admin']);
            $permissions = Permission::pluck('id', 'id')->all();
            $role->syncPermissions($permissions);
            $superAdmin->assignRole([$role->id]);
            $superAdmin->notifyToActivateAdminAccount();
        }
    }
}
