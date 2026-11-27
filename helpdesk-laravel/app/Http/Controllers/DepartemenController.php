<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartemenRequest;
use App\Models\Departemen;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DepartemenController extends Controller
{
    public function index(Request $request): View
    {
        $query = Departemen::withCount('asetPc');

        if ($request->filled('q')) {
            $term = '%' . trim((string) $request->input('q')) . '%';
            $query->where(function ($w) use ($term): void {
                $w->where('kode', 'like', $term)
                    ->orWhere('nama', 'like', $term)
                    ->orWhere('penanggung_jawab', 'like', $term)
                    ->orWhere('lokasi', 'like', $term);
            });
        }

        $departemen = $query->orderBy('id')->get();

        return view('departemen.index', compact('departemen'));
    }

    public function create(): View
    {
        return view('departemen.form', ['departemen' => new Departemen()]);
    }

    public function store(DepartemenRequest $request): RedirectResponse
    {
        Departemen::create($request->validated());

        return redirect()->route('departemen.index')->with('success', 'Departemen berhasil ditambahkan.');
    }

    public function edit(Departemen $departemen): View
    {
        return view('departemen.form', compact('departemen'));
    }

    public function update(DepartemenRequest $request, Departemen $departemen): RedirectResponse
    {
        $departemen->update($request->validated());

        return redirect()->route('departemen.index')->with('success', 'Departemen berhasil diperbarui.');
    }

    public function destroy(Departemen $departemen): RedirectResponse
    {
        $jumlahAset = $departemen->asetPc()->count();

        if ($jumlahAset > 0) {
            return redirect()->route('departemen.index')
                ->with('error', "Departemen \"{$departemen->nama}\" tidak dapat dihapus karena masih memiliki {$jumlahAset} aset PC.");
        }

        $departemen->delete();

        return redirect()->route('departemen.index')->with('success', 'Departemen berhasil dihapus.');
    }
}
