<?php

namespace App\Http\Controllers;

use App\Models\Gangguan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class GangguanController extends Controller
{
    public function daftar()
    {
        $gangguan = Gangguan::orderByDesc('id')->get();

        return view('gangguan.daftar', compact('gangguan'));
    }

    public function index()
    {
        return view('gangguan.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'jenis_gangguan' => 'required|max:100',
            'tingkat_prioritas' => 'required|in:Tinggi,Sedang,Rendah',
            'deskripsi_gangguan' => 'required|max:200',
        ]);

        Gangguan::create($data);

        return redirect()->route('gangguan.daftar')->with('success', 'Gangguan berhasil diajukan.');
    }

    public function edit(Gangguan $gangguan)
    {
        Gate::authorize('update', $gangguan);

        return view('gangguan.edit', compact('gangguan'));
    }

    public function update(Request $request, Gangguan $gangguan)
    {
        Gate::authorize('update', $gangguan);

        $data = $request->validate([
            'jenis_gangguan' => 'required|max:100',
            'tingkat_prioritas' => 'required|in:Tinggi,Sedang,Rendah',
            'deskripsi_gangguan' => 'required|max:200',
        ]);

        $gangguan->update($data);

        return redirect()->route('gangguan.daftar')->with('success', 'Ajuan Gangguan berhasil diperbarui.');
    }

    public function destroy(Gangguan $gangguan)
    {
        Gate::authorize('delete', $gangguan);

        $gangguan->delete();

        return redirect()->route('gangguan.daftar')->with('success', 'Berhasil dihapus.');
    }
}