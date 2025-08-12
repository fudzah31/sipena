<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skpd;

class SkpdSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Badan Kepegawaian Daerah, Pendidikan dan Pelatihan',
            'Badan Kesatuan Bangsa dan Politik',
            'Badan Penanggulangan Bencana Daerah',
            'Badan Perencanaan Pembangunan Daerah, Penelitian dan Pengembangan',
            'Dinas Kebudayaan, Kepemudaan, Olahraga dan Pariwisata',
            'Dinas Kesehatan',
            'Dinas Ketahanan Pangan, Pertanian dan Perikanan',
            'Dinas Komunikasi, Informatika dan Statistik',
            'Dinas Koperasi Usaha Mikro dan Tenaga Kerja',
            'Dinas Lingkungan Hidup',
            'Dinas Pekerjaan Umum dan Penataan Ruang',
            'Dinas Pemadam Kebakaran dan Penyelamatan',
            'Dinas Pemberdayaan Perempuan dan Perlindungan Anak',
            'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu Kota Banjarmasin',
            'Dinas Pengendalian Penduduk, Keluarga Berencana dan Pemberdayaan Masyarakat',
            'Dinas Perdagangan dan Perindustrian',
            'Dinas Perhubungan',
            'Dinas Perpustakaan dan Kearsipan',
            'Dinas Perumahan Rakyat dan Kawasan Permukiman',
            'Dinas Sosial',
            'Dinas Pendidikan',
            'Inspektorat',
            'Kecamatan Banjarmasin Barat',
            'Kecamatan Banjarmasin Selatan',
            'Kecamatan Banjarmasin Tengah',
            'Kecamatan Banjarmasin Timur',
            'Kecamatan Banjarmasin Utara',
            'Satuan Polisi Pamong Praja',
            'Sekretariat Daerah - Bagian Hukum',
            'Sekretariat Daerah - Bagian Kesejahteraan Rakyat',
            'Sekretariat Daerah - Bagian Organisasi',
            'Sekretariat Daerah - Bagian Perekonomian dan Sumber Daya Alam',
            'Sekretariat Daerah - Bagian Pemerintahan',
            'Sekretariat Daerah - Bagian Pengadaan Barang dan Jasa',
            'Sekretariat Daerah - Bagian Protokol dan Komunikasi Pimpinan',
            'Sekretariat Daerah - Bagian Umum',
            'Sekretariat Daerah Bagian - Administrasi Pembangunan',
            'Badan Pengelolaan Keuangan, Pendapatan dan Aset Daerah',
            'Sekretariat DPRD',
        ];

        foreach ($data as $nama) {
            Skpd::updateOrCreate(['nama' => $nama]);
        }
    }
}
