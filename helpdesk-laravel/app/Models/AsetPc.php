<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AsetPc extends Model
{
    protected $table = 'aset_pc';

    protected $fillable = [
        'kode_aset',
        'nama_perangkat',
        'jenis',
        'merek',
        'spesifikasi',
        'departemen_id',
        'kondisi',
        'status',
        'tanggal_pembelian',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tanggal_pembelian' => 'date',
        ];
    }

    /**
     * @return BelongsTo<Departemen, $this>
     */
    public function departemen(): BelongsTo
    {
        return $this->belongsTo(Departemen::class, 'departemen_id');
    }

    /**
     * Filter aset berdasarkan departemen dan kata kunci pencarian.
     *
     * @param  Builder<AsetPc>  $query
     * @return Builder<AsetPc>
     */
    public function scopeFilter(Builder $query, ?int $departemenId = null, ?string $keyword = null): Builder
    {
        if ($departemenId !== null) {
            $query->where('departemen_id', $departemenId);
        }

        if ($keyword !== null && trim($keyword) !== '') {
            $term = '%' . trim($keyword) . '%';
            $query->where(function (Builder $w) use ($term): void {
                $w->where('kode_aset', 'like', $term)
                    ->orWhere('nama_perangkat', 'like', $term)
                    ->orWhere('merek', 'like', $term);
            });
        }

        return $query;
    }

    /**
     * Batasi akses data untuk akun dengan role 'user' hanya ke departemennya.
     *
     * @param  Builder<AsetPc>  $query
     * @return Builder<AsetPc>
     */
    public function scopeForViewer(Builder $query, ?User $user): Builder
    {
        if ($user !== null && $user->isUser()) {
            if ($user->departemen_id === null) {
                return $query->whereRaw('1 = 0');
            }

            return $query->where('departemen_id', $user->departemen_id);
        }

        return $query;
    }
}
