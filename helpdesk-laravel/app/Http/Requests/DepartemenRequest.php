<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DepartemenRequest extends FormRequest
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
        $departemen = $this->route('departemen');
        $id = is_object($departemen) ? $departemen->id : $departemen;

        return [
            'kode' => ['required', 'string', 'max:20', Rule::unique('departemen', 'kode')->ignore($id)],
            'nama' => ['required', 'string', 'max:100'],
            'penanggung_jawab' => ['required', 'string', 'max:100'],
            'lokasi' => ['required', 'string', 'max:100'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'kode.required' => 'Kode departemen wajib diisi.',
            'kode.max' => 'Kode departemen maksimal 20 karakter.',
            'kode.unique' => 'Kode departemen sudah digunakan.',
            'nama.required' => 'Nama departemen wajib diisi.',
            'nama.max' => 'Nama departemen maksimal 100 karakter.',
            'penanggung_jawab.required' => 'Penanggung jawab wajib diisi.',
            'penanggung_jawab.max' => 'Nama penanggung jawab maksimal 100 karakter.',
            'lokasi.required' => 'Lokasi wajib diisi.',
            'lokasi.max' => 'Lokasi maksimal 100 karakter.',
        ];
    }
}
