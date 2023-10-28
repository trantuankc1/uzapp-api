<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Contracts\DataTable;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_login')->insert([
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
