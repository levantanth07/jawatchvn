<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!User::query()->where('email', 'admin@gmail.com')->first()) {
            User::query()->create([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin@123'),
                'role' => 1
            ]);
        }
    }
}
