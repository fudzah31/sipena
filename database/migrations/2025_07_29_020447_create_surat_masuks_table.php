<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratMasuksTable extends Migration
{
    public function up(): void
    {
        Schema::create('surat_masuks', function (Blueprint $table) {
            $table->id();

            // No urut manual
            $table->integer('nomor');

            // No Surat
            $table->string('no_surat');

            // Asal Surat
            $table->string('asal_surat')->nullable();

            // Kategori
            $table->string('kategori')->nullable();

            // Perihal
            $table->string('perihal')->nullable();

            // Isi Surat
            $table->text('isi_surat');

            // Upload file (Word/PDF)
            $table->string('file_path')->nullable();

            // Bidang
            $table->enum('bidang', [
                'SEKRETARIAT',
                'PENGEMBANGAN KOMPETENSI ASN DAN SUMBER DAYA MANUSIA',
                'MUTASI, PENGADAAN, PENILAIAN DAN EVALUASI KINERJA APARAT',
                'PENGADAAN, PEMBERHENTIAN DAN INFORMASI KEPEGAWAIAN',
            ]);

            // Keterangan Penerima
            $table->string('keterangan_penerima');

            // Tanggal Surat
            $table->date('tanggal_surat');

            // Tanggal Terima
            $table->date('tanggal_masuk');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_masuks');
    }
}
