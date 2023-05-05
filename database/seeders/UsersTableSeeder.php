<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => '$2y$10$.sFrj9usW9nw.XwV1WlRY.tjPFKb2K9arVvO7rUy857r8Rmtfl/zm',
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
