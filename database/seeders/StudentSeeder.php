<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class StudentSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Juan DelaCruz',
            'email' => 'juandelacruz@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'student',
            'department' => 'BSIT',
            'cluster'   => 1,
            'group_no'  => 4,
        ]);
        
    }
}

