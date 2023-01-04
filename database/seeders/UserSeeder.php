<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name' => 'rohid',
            'username' => 'rohidtzz',
            'password' => bcrypt('qwerty0009'),
            'email' => 'rohidammarfirdaus@gmail.com',
            'role' => 'admin',
            'gender' => 'pria',
            'no_hp' => '891267417',
            'nik' => '123123'
        ]);

        User::create([
            'name' => 'Yolanda',
            'username' => 'fajaraja',
            'password' => bcrypt('fajar536'),
            'email' => 'yolandafajarutama@gmail.com',
            'role' => 'kordinator',
            'gender' => 'pria',
            'no_hp' => '89267417',
            'nik' => '123123'
        ]);

        // User::create([
        //     'name' => 'ini users',
        //     'username' => 'users',
        //     'password' => bcrypt('rohid123'),
        //     'email' => 'gemersrasta@gmail.com',
        //     'role' => 'user',
        //     'gender' => 'pria',
        //     'no_hp' => '8927417',
        //     'nik' => '123123'
        // ]);


    }
}
