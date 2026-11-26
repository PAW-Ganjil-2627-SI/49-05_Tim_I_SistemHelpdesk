<?php

namespace Database\Seeders;

use App\Models\Gangguan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrNew(['email' => 'admin@example.com']);
        $admin->name = 'Admin IT';
        $admin->password = Hash::make('admin789');
        $admin->role = 'admin';
        $admin->save();

        $teknisi = User::firstOrNew(['email' => 'teknisi@example.com']);
        $teknisi->name = 'Teknisi Jaringan';
        $teknisi->password = Hash::make('teknisi789');
        $teknisi->role = 'teknisi';
        $teknisi->save();

        $user = User::firstOrNew(['email' => 'user@example.com']);
        $user->name = 'User Pelapor';
        $user->password = Hash::make('user789');
        $user->role = 'user';
        $user->save();

        if (! Gangguan::query()->exists()) {
            Gangguan::create([
                'jenis_gangguan' => 'Koneksi Wi-Fi Lab Terputus',
                'tingkat_prioritas' => 'Tinggi',
                'deskripsi_gangguan' => 'Access point di lantai 2 tidak memancarkan sinyal internet sejak pagi.',
            ]);

            Gangguan::create([
                'jenis_gangguan' => 'Printer Ruang Tata Usaha Macet',
                'tingkat_prioritas' => 'Sedang',
                'deskripsi_gangguan' => 'Paper jam pada tray utama dan tinta hitam perlu diisi ulang.',
            ]);
        }
    }
}