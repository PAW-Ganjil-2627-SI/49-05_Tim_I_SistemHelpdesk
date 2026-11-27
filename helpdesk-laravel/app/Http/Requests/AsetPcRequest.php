<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AsetPcRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $aset = $this->route('aset');
        $id = is_object($aset) ? $aset->id : $aset;

        return [
            'kode_aset' => ['required', 'string', 'max:30', Rule::unique('aset_pc', 'kode_aset')->ignore($id)],
            'nama_perangkat' => ['required', 'string', 'max:120'],
            'jenis' => ['required', Rule::in(['PC', 'Laptop'])],
            'merek' => ['required', 'string', 'max:80'],
            'spesifikasi' => ['nullable', 'string'],
            'departemen_id' => ['required', 'exists:departemen,id'],
            'kondisi' => ['required', Rule::in(['Baik', 'Perlu Servis', 'Rusak'])],
            'status' => ['required', Rule::in(['Aktif', 'Perbaikan'])],
            'tanggal_pembelian' => ['nullable', 'date'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'kode_aset.required' => 'Kode aset wajib diisi.',
            'kode_aset.max' => 'Kode aset maksimal 30 karakter.',
            'kode_aset.unique' => 'Kode aset sudah terdaftar.',
            'nama_perangkat.required' => 'Nama perangkat wajib diisi.',
            'nama_perangkat.max' => 'Nama perangkat maksimal 120 karakter.',
            'jenis.required' => 'Jenis perangkat wajib dipilih.',
            'jenis.in' => 'Jenis perangkat harus PC atau Laptop.',
            'merek.required' => 'Merek perangkat wajib diisi.',
            'merek.max' => 'Merek maksimal 80 karakter.',
            'departemen_id.required' => 'Departemen wajib dipilih.',
            'departemen_id.exists' => 'Departemen yang dipilih tidak valid.',
            'kondisi.required' => 'Kondisi aset wajib dipilih.',
            'kondisi.in' => 'Kondisi harus salah satu dari: Baik, Perlu Servis, atau Rusak.',
            'status.required' => 'Status aset wajib dipilih.',
            'status.in' => 'Status harus salah satu dari: Aktif atau Perbaikan.',
            'tanggal_pembelian.date' => 'Format tanggal pembelian tidak valid.',
        ];
    }
}
