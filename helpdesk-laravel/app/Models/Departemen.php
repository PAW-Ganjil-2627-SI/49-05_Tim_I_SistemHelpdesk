<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Departemen extends Model
{
    protected $table = 'departemen';

    protected $fillable = [
        'kode',
        'nama',
        'penanggung_jawab',
        'lokasi',
    ];

    /**
     * @return HasMany<AsetPc, $this>
     */
    public function asetPc(): HasMany
    {
        return $this->hasMany(AsetPc::class, 'departemen_id');
    }

    /**
     * @return HasMany<User, $this>
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'departemen_id');
    }
}
