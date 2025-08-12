<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor',               // 🔢 Nomor urut manual
        'no_surat',            // 🔡 Nomor surat resmi
        'bidang',              // 📂 Bidang pengirim
        'kategori',            // 🏷️ Kategori surat
        'skpd_id',             // 🏢 Tujuan SKPD (relasi)
        'perihal',             // 📝 Perihal
        'tanggal_surat',       // 📅 Tanggal surat
        'tanggal_pengantaran', // 📦 Tanggal kirim
    ];

    // 🔗 Relasi ke SKPD (Tujuan Surat)
    public function skpd()
    {
        return $this->belongsTo(Skpd::class);
    }

    // 🧠 Mutator: kapitalisasi otomatis untuk kategori
    public function setKategoriAttribute($value)
    {
        $this->attributes['kategori'] = strtoupper($value);
    }

    // 🧠 Mutator: kapitalisasi otomatis untuk perihal
    public function setPerihalAttribute($value)
    {
        $this->attributes['perihal'] = strtoupper($value);
    }
}
