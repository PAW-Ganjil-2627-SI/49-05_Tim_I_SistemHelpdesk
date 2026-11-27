<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Sesuai migrasi users: username, password, role
        $akun = [
            ['username' => 'admin',   'role' => 'admin'],
            ['username' => 'teknisi', 'role' => 'teknisi'],
            ['username' => 'user',    'role' => 'user'],
        ];

        // unguarded: supaya kolom 'role' tetap bisa diisi
        // walaupun belum ada di $fillable model User.
        User::unguarded(function () use ($akun) {
            foreach ($akun as $a) {
                // updateOrCreate: aman dijalankan berulang, tidak membuat akun ganda
                User::updateOrCreate(
                    ['username' => $a['username']],
                    [
                        'password' => Hash::make('password123'),
                        'role'     => $a['role'],
                    ]
                );
            }
        });
    }
}
