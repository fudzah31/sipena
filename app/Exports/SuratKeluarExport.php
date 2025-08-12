<?php

namespace App\Exports;

use App\Models\SuratKeluar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class SuratKeluarExport implements FromCollection, WithHeadings, WithMapping
{
    protected $bulan;
    protected $tahun;

    public function __construct($bulan, $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    /**
     * Ambil data sesuai bulan & tahun, urutkan berdasarkan nomor.
     */
    public function collection()
    {
        return SuratKeluar::with('skpd')
            ->whereMonth('tanggal_surat', $this->bulan)
            ->whereYear('tanggal_surat', $this->tahun)
            ->orderBy('nomor')
            ->get();
    }

    /**
     * Heading kolom di Excel.
     */
    public function headings(): array
    {
        return [
            'No',           // nomor manual
            'No Surat',
            'Bidang',
            'Kategori',
            'SKPD',
            'Perihal',
            'Tgl Surat',
            'Tgl Kirim',
        ];
    }

    /**
     * Mapping tiap baris: pastikan kolom pertama adalah $item->nomor.
     */
    public function map($item): array
    {
        return [
            $item->nomor,
            $item->no_surat,
            $item->bidang,
            $item->kategori,
            $item->skpd->nama ?? '-',
            $item->perihal,
            Carbon::parse($item->tanggal_surat)->format('d-m-Y'),
            Carbon::parse($item->tanggal_pengantaran)->format('d-m-Y'),
        ];
    }
}
