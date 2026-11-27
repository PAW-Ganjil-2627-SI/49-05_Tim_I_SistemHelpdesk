<?php

namespace Database\Seeders;

use App\Models\AsetPc;
use App\Models\Departemen;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $hrd = Departemen::updateOrCreate(
            ['kode' => 'HRD'],
            [
                'nama' => 'HRD',
                'penanggung_jawab' => 'Rina Kusuma',
                'lokasi' => 'Gedung A - Lantai 2',
            ]
        );

        $finance = Departemen::updateOrCreate(
            ['kode' => 'FIN'],
            [
                'nama' => 'Finance',
                'penanggung_jawab' => 'Budi Santoso',
                'lokasi' => 'Gedung A - Lantai 3',
            ]
        );

        $operasional = Departemen::updateOrCreate(
            ['kode' => 'OPS'],
            [
                'nama' => 'Operasional',
                'penanggung_jawab' => 'Andi Wijaya',
                'lokasi' => 'Gedung B - Lantai 1',
            ]
        );

        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'departemen_id' => null,
            ]
        );

        User::updateOrCreate(
            ['username' => 'teknisi'],
            [
                'password' => Hash::make('teknisi123'),
                'role' => 'teknisi',
                'departemen_id' => null,
            ]
        );

        User::updateOrCreate(
            ['username' => 'user'],
            [
                'password' => Hash::make('user123'),
                'role' => 'user',
                'departemen_id' => $hrd->id,
            ]
        );

        $daftarAset = [
            [
                'kode_aset' => 'AST-HRD-001',
                'nama_perangkat' => 'PC Rekrutmen 01',
                'jenis' => 'PC',
                'merek' => 'Dell OptiPlex 7010',
                'spesifikasi' => 'Intel Core i5-13500, RAM 16GB DDR4, SSD 512GB NVMe, Monitor 24"',
                'departemen_id' => $hrd->id,
                'kondisi' => 'Baik',
                'status' => 'Aktif',
                'tanggal_pembelian' => '2024-02-15',
            ],
            [
                'kode_aset' => 'AST-HRD-002',
                'nama_perangkat' => 'Laptop HR Manager',
                'jenis' => 'Laptop',
                'merek' => 'Lenovo ThinkPad T14',
                'spesifikasi' => 'Intel Core i7-1365U, RAM 16GB, SSD 512GB, Layar 14" FHD',
                'departemen_id' => $hrd->id,
                'kondisi' => 'Baik',
                'status' => 'Aktif',
                'tanggal_pembelian' => '2024-05-10',
            ],
            [
                'kode_aset' => 'AST-HRD-003',
                'nama_perangkat' => 'Laptop Staff Payroll',
                'jenis' => 'Laptop',
                'merek' => 'HP ProBook 440 G9',
                'spesifikasi' => 'Intel Core i5-1235U, RAM 8GB, SSD 256GB',
                'departemen_id' => $hrd->id,
                'kondisi' => 'Perlu Servis',
                'status' => 'Perbaikan',
                'tanggal_pembelian' => '2023-08-20',
            ],
            [
                'kode_aset' => 'AST-FIN-001',
                'nama_perangkat' => 'PC Akuntansi 01',
                'jenis' => 'PC',
                'merek' => 'HP ProDesk 400 G9',
                'spesifikasi' => 'Intel Core i5-12500, RAM 16GB, SSD 512GB, Dual Monitor',
                'departemen_id' => $finance->id,
                'kondisi' => 'Baik',
                'status' => 'Aktif',
                'tanggal_pembelian' => '2024-01-12',
            ],
            [
                'kode_aset' => 'AST-FIN-002',
                'nama_perangkat' => 'Laptop Audit Internal',
                'jenis' => 'Laptop',
                'merek' => 'Dell Latitude 5430',
                'spesifikasi' => 'Intel Core i7-1265U, RAM 16GB, SSD 1TB',
                'departemen_id' => $finance->id,
                'kondisi' => 'Perlu Servis',
                'status' => 'Aktif',
                'tanggal_pembelian' => '2023-11-04',
            ],
            [
                'kode_aset' => 'AST-FIN-003',
                'nama_perangkat' => 'PC Kasir & Pajak',
                'jenis' => 'PC',
                'merek' => 'Asus ExpertCenter D5',
                'spesifikasi' => 'Intel Core i3-12100, RAM 8GB, SSD 256GB',
                'departemen_id' => $finance->id,
                'kondisi' => 'Rusak',
                'status' => 'Perbaikan',
                'tanggal_pembelian' => '2022-07-18',
            ],
            [
                'kode_aset' => 'AST-OPS-001',
                'nama_perangkat' => 'PC Command Center 01',
                'jenis' => 'PC',
                'merek' => 'Lenovo ThinkCentre M70q',
                'spesifikasi' => 'Intel Core i7-13700T, RAM 32GB, SSD 1TB NVMe',
                'departemen_id' => $operasional->id,
                'kondisi' => 'Baik',
                'status' => 'Aktif',
                'tanggal_pembelian' => '2025-01-08',
            ],
            [
                'kode_aset' => 'AST-OPS-002',
                'nama_perangkat' => 'Laptop Supervisor Lapangan',
                'jenis' => 'Laptop',
                'merek' => 'Acer TravelMate P4',
                'spesifikasi' => 'Intel Core i5-1335U, RAM 16GB, SSD 512GB',
                'departemen_id' => $operasional->id,
                'kondisi' => 'Rusak',
                'status' => 'Perbaikan',
                'tanggal_pembelian' => '2023-03-27',
            ],
        ];

        foreach ($daftarAset as $aset) {
            AsetPc::updateOrCreate(
                ['kode_aset' => $aset['kode_aset']],
                $aset
            );
        }
    }
}
