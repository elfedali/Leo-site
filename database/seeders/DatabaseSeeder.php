<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Core\Constants;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'username' => 'webmaster',
            'first_name' => 'Web',
            'last_name' => 'Master',
            'email' => 'webmaster@leo.ma',
            'role' => Constants::USER_ROLE_ADMIN,
        ]);

        \App\Models\User::factory()->create([
            'username' => 'editor',
            'first_name' => 'Editor',
            'last_name' => 'User',
            'email' => 'editor@leo.ma',
        ]);

        \App\Models\User::factory(10)->create();
        \App\Models\Node::factory(100)->create();
    }
}
