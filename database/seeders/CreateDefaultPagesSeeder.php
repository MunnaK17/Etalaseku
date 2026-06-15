<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\User;
use Illuminate\Database\Seeder;

class CreateDefaultPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users
        $users = User::all();

        foreach ($users as $user) {
            Page::ensureDefaultForUser($user->id, 'Home', 0);
        }

        $this->command->info('Created default "Home" pages for all users.');
    }
}
