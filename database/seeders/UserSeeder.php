<?php

namespace Database\Seeders;

use App\Models\AdminLogin;
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
        AdminLogin::query()->insert([
           'id' => 1,
           'name' => 'admin',
           'email' => 'trantuankc1@gmail.com',
           'password' => bcrypt('trantuankc1'),
           'role' => 1,
           'status' => 1,
           'created_at' => now(),
           'updated_at' => now(),
        ]);
    }
}
