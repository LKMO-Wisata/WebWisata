<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash; // <-- TAMBAHKAN INI

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'admin@example.com' // Kunci untuk mencari/memperbarui
            ],
            [
                'name' => 'Admin',
                // Gunakan Hash::make() untuk mengenkripsi password dengan aman
                'password' => Hash::make('password123') 
            ]
        );
    }
}