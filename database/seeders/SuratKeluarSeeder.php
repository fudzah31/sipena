<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SuratKeluar;
use App\Models\Skpd;

class SuratKeluarSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil atau fallback ID SKPD
        $skpd1 = Skpd::firstOrCreate(['nama' => 'Dinas Pendidikan'])->id;
        $skpd2 = Skpd::firstOrCreate(['nama' => 'BPKP'])->id;
        $skpd3 = Skpd::firstOrCreate(['nama' => 'Dinas Kesehatan'])->id;

        $data = [
            [
                'nomor'                => 1,
                'no_surat'             => '800/001/BKD/2025',
                'bidang'               => 'SEKRETARIAT',
                'kategori'             => 'UNDANGAN',
                'skpd_id'              => $skpd1,
                'perihal'              => 'Undangan rapat koordinasi',
                'tanggal_surat'        => '2025-07-10',
                'tanggal_pengantaran'  => '2025-07-11',
            ],
            [
                'nomor'                => 2,
                'no_surat'             => '800/002/BKD/2025',
                'bidang'               => 'PENGEMBANGAN KOMPETENSI ASN DAN SUMBER DAYA MANUSIA',
                'kategori'             => 'PERMINTAAN DATA',
                'skpd_id'              => $skpd2,
                'perihal'              => 'Permintaan data pelatihan ASN',
                'tanggal_surat'        => '2025-07-12',
                'tanggal_pengantaran'  => '2025-07-13',
            ],
            [
                'nomor'                => 3,
                'no_surat'             => '800/003/BKD/2025',
                'bidang'               => 'MUTASI, PENGADAAN, PENILAIAN DAN EVALUASI KINERJA APARATUR',
                'kategori'             => 'PEMBERITAHUAN',
                'skpd_id'              => $skpd3,
                'perihal'              => 'Pemberitahuan mutasi pegawai',
                'tanggal_surat'        => '2025-07-15',
                'tanggal_pengantaran'  => '2025-07-16',
            ],
        ];

        foreach ($data as $item) {
            SuratKeluar::create($item);
        }
    }
}
