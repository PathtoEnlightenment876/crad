<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $students = [
            [
                'name' => 'Juan DelaCruz',
                'email' => 'juandelacruz@gmail.com',
                'password' => 'j04D11@CrU$-',
                'role' => 'student',
                'department' => 'BSIT',
                'section_cluster' => 4101,
                'group_no' => 1,
            ],
            [
                'name' => 'Maria Santos',
                'email' => 'mariasantos@gmail.com',
                'password' => 'mS@12345',
                'role' => 'student',
                'department' => 'CRIM',
                'section_cluster' => 4102,
                'group_no' => 2,
            ],
            [
                'name' => 'Pedro Cruz',
                'email' => 'pedrocruz@gmail.com',
                'password' => 'pC#9876',
                'role' => 'student',
                'department' => 'EDUC',
                'section_cluster' => 4103,
                'group_no' => 1,
            ],
        ];

        foreach ($students as $student) {
            User::updateOrCreate(
                ['email' => $student['email']], // prevent duplicates
                [
                    'name' => $student['name'],
                    'password' => Hash::make($student['password']),
                    'role' => $student['role'],
                    'department' => $student['department'],
                    'section_cluster' => $student['section_cluster'],
                    'group_no' => $student['group_no'],
                ]
            );
        }
    }
}
