<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\AsetPc */
class AsetPcResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'kode_aset' => $this->kode_aset,
            'nama_perangkat' => $this->nama_perangkat,
            'jenis' => $this->jenis,
            'merek' => $this->merek,
            'spesifikasi' => $this->spesifikasi,
            'departemen_id' => $this->departemen_id,
            'departemen' => DepartemenResource::make($this->whenLoaded('departemen')),
            'kondisi' => $this->kondisi,
            'status' => $this->status,
            'tanggal_pembelian' => $this->tanggal_pembelian?->format('Y-m-d'),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
