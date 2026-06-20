<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AtasanUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::firstOrCreate(
            ['email' => 'atasan@saranaku.com'],
            [
                'name' => 'Atasan Utama',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'atasan',
            ]
        );
    }
}
