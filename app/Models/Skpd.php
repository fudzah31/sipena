<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skpd extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'kode'];

    /**
     * Relasi: SKPD memiliki banyak Surat Keluar
     */
    public function suratKeluars()
    {
        return $this->hasMany(SuratKeluar::class);
    }

    /**
     * Relasi: SKPD memiliki banyak Nota Dinas
     */
    public function notaDinas()
    {
        return $this->hasMany(NotaDinas::class);
    }
}
