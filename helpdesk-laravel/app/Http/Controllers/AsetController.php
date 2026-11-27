<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AsetController extends Controller
{
    public function index(Request $request)
    {
        $query = Aset::query();

        if ($request->filled('unit')) {
            $query->where('unit', $request->unit);
        }

        if ($request->filled('q')) {
            $query->where(function ($w) use ($request) {
                $w->where('kode', 'like', '%' . $request->q . '%')
                  ->orWhere('nama', 'like', '%' . $request->q . '%');
            });
        }

        $aset = $query->orderBy('id')->get();

        return view('aset.index', compact('aset'));
    }

    public function create()
    {
        return view('aset.form', ['aset' => new Aset()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());

        Aset::create($data);

        return redirect()->route('aset.index')->with('success', 'Aset berhasil ditambahkan.');
    }

    public function edit(Aset $aset)
    {
        return view('aset.form', compact('aset'));
    }

    public function update(Request $request, Aset $aset)
    {
        $data = $request->validate($this->rules($aset->id));

        $aset->update($data);

        return redirect()->route('aset.index')->with('success', 'Aset berhasil diperbarui.');
    }

    public function destroy(Aset $aset)
    {
        $aset->delete();

        return redirect()->route('aset.index')->with('success', 'Aset berhasil dihapus.');
    }

    private function rules($id = null): array
    {
        return [
            'kode' => ['required', 'max:20', Rule::unique('aset', 'kode')->ignore($id)],
            'nama' => 'required|max:100',
            'unit' => 'required|in:HRD,Finance,OPS',
            'kondisi' => 'required|in:Baik,Perlu Servis,Rusak',
            'status' => 'required|in:Aktif,Perbaikan',
        ];
    }
}