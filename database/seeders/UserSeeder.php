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
            'username' => 'rohid',
            'password' => bcrypt('rohid123'),
            'email' => 'hidtzz@gmail.com',
            'role' => 'admin',
            'gender' => 'pria',
            'no_hp' => '891267417'
        ]);

        User::create([
            'name' => 'rasdasd',
            'username' => 'kordi',
            'password' => bcrypt('rohid123'),
            'email' => 'hidtz@gmail.com',
            'role' => 'kordinator',
            'gender' => 'pria',
            'no_hp' => '89267417'
        ]);

        User::create([
            'name' => 'rasdasd',
            'username' => 'users',
            'password' => bcrypt('rohid123'),
            'email' => 'hidt@gmail.com',
            'role' => 'user',
            'gender' => 'pria',
            'no_hp' => '8927417'
        ]);


    }
}
