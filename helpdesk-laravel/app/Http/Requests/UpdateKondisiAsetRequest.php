<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateKondisiAsetRequest extends FormRequest
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
        return [
            'kondisi' => ['required', Rule::in(['Baik', 'Perlu Servis', 'Rusak'])],
            'status' => ['required', Rule::in(['Aktif', 'Perbaikan'])],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'kondisi.required' => 'Kondisi aset wajib dipilih.',
            'kondisi.in' => 'Kondisi harus salah satu dari: Baik, Perlu Servis, atau Rusak.',
            'status.required' => 'Status aset wajib dipilih.',
            'status.in' => 'Status harus salah satu dari: Aktif atau Perbaikan.',
        ];
    }
}
