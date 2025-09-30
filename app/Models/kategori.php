<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kategori',
        'keterangan',
    ];

    public function arsips()
    {
        return $this->hasMany(Arsip::class, 'kategori_id');
    }
}
