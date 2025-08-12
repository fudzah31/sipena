<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor',
        'no_surat',
        'asal_surat',
        'kategori',
        'perihal',
        'isi_surat',
        'file_path',
        'bidang',
        'keterangan_penerima',
        'tanggal_surat',
        'tanggal_masuk',
    ];

    /**
     * Mutator: uppercase kategori
     */
    public function setKategoriAttribute($value)
    {
        $this->attributes['kategori'] = strtoupper($value);
    }

    /**
     * Mutator: uppercase perihal
     */
    public function setPerihalAttribute($value)
    {
        $this->attributes['perihal'] = strtoupper($value);
    }

    /**
     * Mutator: uppercase keterangan penerima
     */
    public function setKeteranganPenerimaAttribute($value)
    {
        $this->attributes['keterangan_penerima'] = strtoupper($value);
    }
}
