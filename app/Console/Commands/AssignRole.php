<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Role;

class AssignRole extends Command
{
    protected $signature = 'user:assign-role {email : The email of the user} {role : The name of the role}';

    protected $description = 'Assign a role to a user';

    public function handle()
    {
        $email = $this->argument('email');
        $roleName = $this->argument('role');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error('User not found.');
            return;
        }

        $role = Role::where('name', $roleName)->first();

        if (!$role) {
            $this->error('Role not found.');
            return;
        }

        $user->role()->associate($role);
        $user->save();

        $this->info("Role '{$roleName}' assigned to user '{$email}' successfully.");
    }
}
