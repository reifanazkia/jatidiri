<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin Baru',
            'email' => 'admin123@gmail.com',
            'password' => Hash::make('Aelxander123'), // otomatis hash
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
