<?php

namespace App\Exports;

use App\Models\NotaDinas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class NotaDinasExport implements FromCollection, WithHeadings, WithMapping
{
    protected $progress;

    public function __construct($progress = null)
    {
        $this->progress = $progress;
    }

    public function collection()
    {
        $q = NotaDinas::with('skpd');
        if ($this->progress) {
            $q->where('progress', $this->progress);
        }
        return $q->orderBy('nomor')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nomor Nota',
            'SKPD',
            'Penerima',
            'Perihal',
            'Progress',
            'Tanggal Buat',
        ];
    }

    public function map($it): array
    {
        return [
            $it->nomor,
            $it->nomor_nota,
            $it->skpd->nama ?? '-',
            $it->penerima,
            $it->perihal,
            $it->progress,
            Carbon::parse($it->created_at)->format('d-m-Y'),
        ];
    }
}
