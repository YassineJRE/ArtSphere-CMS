<?php

namespace App\Console\Commands\Admin;

use App\Exceptions\CommandException;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user.';

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
     * @return int
     */
    public function handle()
    {
        try {
            if (Role::count() <= 0) {
                throw new CommandException('There is no Role in DB');
            }

            $first_name = $this->ask('Enter first name?');
            $first_name = filter_var($first_name, FILTER_SANITIZE_STRING);

            if (empty($first_name)) {
                throw new CommandException('First name is required');
            }

            $last_name = $this->ask('Enter last name?');
            $last_name = filter_var($last_name, FILTER_SANITIZE_STRING);

            if (empty($last_name)) {
                throw new CommandException('Last name is required');
            }

            $email = $this->ask('Enter email?');
            $email = filter_var($email, FILTER_SANITIZE_STRING);

            if (empty($email)) {
                throw new CommandException('Email is required');
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new CommandException('Invalid email');
            }

            if (User::where('email', $email)->exists()) {
                throw new CommandException('A user with this email already exists');
            }

            $password = $this->secret('What is the password?');

            if (empty($password)) {
                throw new CommandException('Password is required');
            }

            if (strlen($password) < 6) {
                throw new CommandException('The password must be at least 6 characters');
            }

            $confirmation_password = $this->secret('Re-enter the password?');

            if (empty($confirmation_password)) {
                throw new CommandException('Confirmation Password is required');
            }

            if ($password !== $confirmation_password) {
                throw new CommandException('Wrong password');
            }

            $roleName = $this->choice(
                'Select role?',
                Role::pluck('id', 'name')->all(),
                Role::first()->id,
                2,
                false
            );

            Artisan::call('permission:update');

            $user = new User([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'password' => Hash::make($password),
                'can_access_admin' => 'Super Admin' === $roleName,
            ]);

            if ($user->save()) {
                $role = Role::findByName($roleName);

                if ($role) {
                    $permissions = Permission::pluck('id', 'id')->all();
                    $role->syncPermissions($permissions);
                    $user->assignRole([$role->id]);
                }

                return $this->info("Registration $roleName $user->first_name $user->last_name ($user->email) with id ".$user->id);
            }

            throw new CommandException('Creation failed');
        } catch (CommandException $exception) {
            return $this->error($exception->getMessage());
        }
    }
}
