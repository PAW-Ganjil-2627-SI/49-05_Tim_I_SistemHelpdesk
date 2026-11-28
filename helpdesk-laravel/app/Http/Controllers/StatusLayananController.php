<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StatusLayananController extends Controller
{
    public function index()
    {
        $response = Http::get('https://www.cloudflarestatus.com/api/v2/summary.json');
        $json = $response->json();

        // Data tunggal
        $namaLayanan = $json['page']['name'] ?? 'Cloudflare';
        $statusUmum = $json['status']['description'] ?? 'Tidak diketahui';

        // Data berupa daftar [ ]
        $daftarKomponen = $json['components'] ?? [];

        return view('gangguan.status-layanan', compact('namaLayanan', 'statusUmum', 'daftarKomponen'));
    }
}