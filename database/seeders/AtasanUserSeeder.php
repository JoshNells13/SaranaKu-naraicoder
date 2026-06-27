<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AtasanUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'atasan@saranaku.com'],
            [
                'name' => 'Atasan Utama',
                'password' => Hash::make('password'),
                'role' => 'atasan',
            ]
        );
    }
}
