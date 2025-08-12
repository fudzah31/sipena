<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaDinas extends Model
{
    use HasFactory;

    protected $table = 'nota_dinas';

    protected $fillable = [
        'nomor',
        'nomor_nota',
        'skpd_id',
        'penerima',
        'perihal',
        'progress',
    ];

    /**
     * Relasi ke SKPD (Tujuan Surat)
     */
    public function skpd()
    {
        return $this->belongsTo(Skpd::class);
    }

    /**
     * Set penerima jadi huruf kapital
     */
    public function setPenerimaAttribute($value)
    {
        $this->attributes['penerima'] = strtoupper($value);
    }

    /**
     * Set progress ke uppercase untuk konsistensi
     */
    public function setProgressAttribute($value)
    {
        $this->attributes['progress'] = strtoupper($value);
    }
}
