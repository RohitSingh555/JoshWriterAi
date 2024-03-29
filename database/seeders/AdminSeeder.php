<?php

namespace Database\Seeders;

use App\Models\AllowedUsers;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'role' => 'Admin',
            'password' => bcrypt('12345678'),
        ]);
        AllowedUsers::create([
            'email' => 'admin@admin.com'
        ]);
    }
}
