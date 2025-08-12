<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SuratMasuk;

class SuratMasukSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nomor' => 1,
                'no_surat' => 'SM-001/2025',
                'asal_surat' => 'BKD Provinsi',
                'kategori' => 'undangan',
                'perihal' => 'rapat koordinasi',
                'isi_surat' => 'Undangan rapat koordinasi bidang kepegawaian.',
                'file_path' => 'surat/sm-001.pdf',
                'bidang' => 'SEKRETARIAT',
                'keterangan_penerima' => 'Kepala Bidang Umum',
                'tanggal_surat' => '2025-07-01',
                'tanggal_masuk' => '2025-07-02',
            ],
            [
                'nomor' => 2,
                'no_surat' => 'SM-002/2025',
                'asal_surat' => 'BKN',
                'kategori' => 'permintaan data',
                'perihal' => 'laporan tahunan ASN',
                'isi_surat' => 'Permohonan data ASN untuk pelaporan tahunan.',
                'file_path' => 'surat/sm-002.pdf',
                'bidang' => 'PENGEMBANGAN KOMPETENSI ASN DAN SUMBER DAYA MANUSIA',
                'keterangan_penerima' => 'Kasubag Data Kepegawaian',
                'tanggal_surat' => '2025-07-05',
                'tanggal_masuk' => '2025-07-06',
            ],
            [
                'nomor' => 3,
                'no_surat' => 'SM-003/2025',
                'asal_surat' => 'Kemenpan-RB',
                'kategori' => 'pemberitahuan',
                'perihal' => 'mutasi pegawai',
                'isi_surat' => 'Pemberitahuan mutasi PNS antar instansi.',
                'file_path' => 'surat/sm-003.pdf',
                'bidang' => 'MUTASI, PENGADAAN, PENILAIAN DAN EVALUASI KINERJA APARAT',
                'keterangan_penerima' => 'Kepala Bidang Mutasi',
                'tanggal_surat' => '2025-07-10',
                'tanggal_masuk' => '2025-07-11',
            ],
        ];

        foreach ($data as $item) {
            SuratMasuk::create($item);
        }
    }
}
