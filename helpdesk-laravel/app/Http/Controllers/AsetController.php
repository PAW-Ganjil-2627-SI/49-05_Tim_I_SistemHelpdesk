<?php

namespace App\Http\Controllers;

use App\Http\Requests\AsetPcRequest;
use App\Http\Requests\UpdateKondisiAsetRequest;
use App\Models\AsetPc;
use App\Models\Departemen;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class AsetController extends Controller
{
    public function index(Request $request): View
    {
        $user = Auth::user();
        $departemenList = Departemen::orderBy('id')->get();

        $departemenId = ($user !== null && $user->isUser())
            ? null
            : ($request->filled('departemen_id') ? (int) $request->input('departemen_id') : null);

        $aset = AsetPc::with('departemen')
            ->forViewer($user)
            ->filter($departemenId, $request->input('q'))
            ->orderBy('id')
            ->get();

        return view('aset.index', compact('aset', 'departemenList', 'departemenId'));
    }

    public function show(AsetPc $aset): View
    {
        $aset->load('departemen');

        // The 'view-aset' gate uses ?User so it allows guests (returns true for non-users)
        Gate::authorize('view-aset', $aset);

        return view('aset.show', compact('aset'));
    }

    public function create(): View
    {
        $departemenList = Departemen::orderBy('nama')->get();

        return view('aset.form', [
            'aset' => new AsetPc(),
            'departemenList' => $departemenList,
        ]);
    }

    public function store(AsetPcRequest $request): RedirectResponse
    {
        AsetPc::create($request->validated());

        return redirect()->route('aset.index')->with('success', 'Aset PC berhasil ditambahkan.');
    }

    public function edit(AsetPc $aset): View
    {
        $departemenList = Departemen::orderBy('nama')->get();

        return view('aset.form', compact('aset', 'departemenList'));
    }

    public function update(AsetPcRequest $request, AsetPc $aset): RedirectResponse
    {
        $aset->update($request->validated());

        return redirect()->route('aset.index')->with('success', 'Aset PC berhasil diperbarui.');
    }

    public function editKondisi(AsetPc $aset): View
    {
        $aset->load('departemen');

        return view('aset.kondisi', compact('aset'));
    }

    public function updateKondisi(UpdateKondisiAsetRequest $request, AsetPc $aset): RedirectResponse
    {
        $aset->update($request->validated());

        return redirect()->route('aset.index')->with('success', 'Kondisi dan status aset berhasil diperbarui.');
    }

    public function destroy(AsetPc $aset): RedirectResponse
    {
        $aset->delete();

        return redirect()->route('aset.index')->with('success', 'Aset PC berhasil dihapus.');
    }
}
