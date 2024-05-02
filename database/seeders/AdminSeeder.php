<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admins')->insert([
            'name' => 'Muhammed',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789'),
        ]);
    }


    // in seeders

        // User::create([
        //     'name' => 'Administrator',
        //      'email' => 'mohamed@io.com',
        //     'password_hash' => Hash::make('123456789'),
        //     'phone_number' => '123456789',
        // ]);
            //-------OR------//
        // DB::table('users')->insert([
        //     'name' => 'Admin Admin',
        //     'email' => 'admin@io.com',
        //     'password_hash' => Hash::make('123456789'),
        //     'phone_number' => '123456789347898765',
        // ]);
}