<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    protected $table = 'aset';

    public $timestamps = false;

    protected $fillable = ['kode', 'nama', 'unit', 'kondisi', 'status'];
}