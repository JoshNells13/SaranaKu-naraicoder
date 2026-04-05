<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin SaranaKu',
            'email' => 'admin@saranaku.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Alex Student',
            'email' => 'alex@student.com',
            'password' => Hash::make('password'),
            'role' => 'murid',
            'kelas' => 'XII IPA 1',
            'jurusan' => 'IPA',
        ]);

        User::create([
            'name' => 'Elena Rodriguez',
            'email' => 'elena@student.com',
            'password' => Hash::make('password'),
            'role' => 'murid',
            'kelas' => 'XI IPS 2',
            'jurusan' => 'IPS',
        ]);

        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@student.com',
            'password' => Hash::make('password'),
            'role' => 'murid',
            'kelas' => 'X MIPA 3',
            'jurusan' => 'MIPA',
        ]);
    }
}
