<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Dr. Jane Doa',
            'alamat' => 'Jl. Jendral Sudirman No. 1',
            'no_hp' => '081234567890',
            'email' => 'janedoa@gmail.com',
            'role' => 'dokter',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'nama' => 'John Doe',
            'alamat' => 'Jl. Jendral Sudirman No. 2',
            'no_hp' => '081234567891',
            'email' => 'johndoe@gmail.com',
            'role' => 'pasien',
            'password' => Hash::make('password'),
        ]);
    }
}
