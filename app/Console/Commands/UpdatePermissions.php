<?php

namespace App\Console\Commands;

use App\Enums\PrivilegeAdmin;
use App\Enums\PrivilegeAuthentication;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;

class UpdatePermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update permissions in database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->addPrivilegeAdmin();
        $this->addPrivilegeAuthentication();
    }

    protected function addPrivilegeAdmin()
    {
        foreach (PrivilegeAdmin::web() as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $this->info('Admin Permissions updated in database');
    }

    protected function addPrivilegeAuthentication()
    {
        foreach (PrivilegeAuthentication::web() as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $this->info('Authentication Permissions updated in database');
    }
}
