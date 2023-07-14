<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Bruce Wayne',
                'email' => 'bwayne@bat.com',
                'role' => 'Dark Knight',
                'password' => Hash::make('batsecret'),
            ],
            [
                'name' => 'Bob Kane',
                'email' => 'bkane@bat.com',
                'role' => 'Support',
                'password' => Hash::make('robinsecret'),
            ],

            [
                'name' => 'Alfred Thaddeus',
                'email' => 'athaddeus@bat.com',
                'role' => 'Butler',
                'password' => Hash::make('destroy'),
            ],
        ];

       User::insert($users);
    }
}
