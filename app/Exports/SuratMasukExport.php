<?php

namespace App\Exports;

use App\Models\SuratMasuk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SuratMasukExport implements FromCollection, WithHeadings, WithMapping
{
    protected $bulan, $tahun;

    public function __construct($bulan, $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function collection()
    {
        return SuratMasuk::whereMonth('tanggal_surat', $this->bulan)
            ->whereYear('tanggal_surat', $this->tahun)
            ->orderBy('tanggal_masuk', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Nomor',
            'No Surat',
            'Asal Surat',
            'Kategori',
            'Perihal',
            'Isi Surat',
            'File',
            'Bidang',
            'Keterangan Penerima',
            'Tanggal Surat',
            'Tanggal Masuk',
        ];
    }

    public function map($row): array
    {
        return [
            $row->nomor,
            $row->no_surat,
            $row->asal_surat,
            $row->kategori,
            $row->perihal,
            strip_tags($row->isi_surat),
            $row->file_path ? 'Ada File' : '-',
            $row->bidang,
            $row->keterangan_penerima,
            $row->tanggal_surat,
            $row->tanggal_masuk,
        ];
    }
}
