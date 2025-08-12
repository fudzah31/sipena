<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nota_dinas', function (Blueprint $table) {
            $table->id();

            // ✅ Nomor urut manual (input sendiri seperti "1", "2", dst)
            $table->string('nomor');

            // ✅ Nomor resmi nota dinas (seperti "800/001/ND/2025")
            $table->string('nomor_nota');

            // FK ke SKPD
            $table->foreignId('skpd_id')
                ->constrained('skpds')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            // Penerima internal
            $table->string('penerima');

            // Perihal
            $table->string('perihal');

            // ✅ Progress Tracking
            $table->enum('progress', [
                'DIKIRIM',
                'DALAM PERJALANAN',
                'DITERIMA INSTANSI TUJUAN',
                'SELESAI',
                'DIBATALKAN'
            ])->default('DIKIRIM');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nota_dinas');
    }
};
