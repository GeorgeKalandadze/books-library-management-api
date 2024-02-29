<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class RemoveRole extends Command
{
    protected $signature = 'user:remove-role {email : The email of the user}';

    protected $description = 'Remove role from a user';

    public function handle()
    {
        $email = $this->argument('email');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error('User not found.');
            return;
        }

        if (!$user->role) {
            $this->error('User does not have a role assigned.');
            return;
        }

        $user->role()->dissociate();
        $user->save();

        $this->info("Role removed from user '{$email}' successfully.");
    }
}
