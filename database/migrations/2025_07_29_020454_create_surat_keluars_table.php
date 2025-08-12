<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_keluars', function (Blueprint $table) {
            $table->id();

            // 🔢 Nomor urut manual seperti di surat masuk
            $table->integer('nomor');

            // 🔡 Nomor surat resmi, misalnya "094/PKASN/08/2025"
            $table->string('no_surat'); 

            // 📂 Enum bidang
            $table->enum('bidang', [
                'SEKRETARIAT',
                'PENGEMBANGAN KOMPETENSI ASN DAN SUMBER DAYA MANUSIA',
                'MUTASI, PENGADAAN, PENILAIAN DAN EVALUASI KINERJA APARATUR',
                'PENGADAAN, PEMBERHENTIAN DAN INFORMASI KEPEGAWAIAN',
            ]);

            // 🗂️ Kategori
            $table->string('kategori');

            // 🏢 Foreign key ke SKPD
            $table->foreignId('skpd_id')
                  ->constrained('skpds')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();

            // 📝 Perihal
            $table->string('perihal');

            // 📅 Tanggal surat dan pengantaran
            $table->date('tanggal_surat');
            $table->date('tanggal_pengantaran');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_keluars');
    }
};
