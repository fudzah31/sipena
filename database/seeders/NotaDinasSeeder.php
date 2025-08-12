<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\NotaDinas;
use App\Models\Skpd;

class NotaDinasSeeder extends Seeder
{
    public function run(): void
    {
        // 🔄 Hapus data lama
        DB::table('nota_dinas')->truncate();

        // Cari SKPD atau fallback ID
        $skpd1 = Skpd::firstOrCreate(['nama' => 'Dinas Pendidikan'])->id;
        $skpd2 = Skpd::firstOrCreate(['nama' => 'BKD Provinsi'])->id;

        // 📥 Data dummy
        $data = [
            [
                'nomor'       => '1',
                'nomor_nota'  => '800/ND/2025',
                'skpd_id'     => $skpd1,
                'penerima'    => 'KEPALA BAGIAN UMUM',
                'perihal'     => 'Permohonan Data Pegawai',
                'progress'    => 'DIKIRIM',
            ],
            [
                'nomor'       => '2',
                'nomor_nota'  => '801/ND/2025',
                'skpd_id'     => $skpd2,
                'penerima'    => 'SEKRETARIS DAERAH',
                'perihal'     => 'Undangan Rapat Koordinasi',
                'progress'    => 'DALAM PERJALANAN',
            ],
        ];

        // ⛳ Simpan ke database
        foreach ($data as $item) {
            NotaDinas::create($item);
        }
    }
}
