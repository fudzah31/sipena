<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\SuratKeluarExport;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Carbon\Carbon;

class ArsipSuratKeluarController extends Controller
{
    public function form()
    {
        return view('arsip.surat_keluar.form');
    }

    public function preview(Request $r)
    {
        $items = SuratKeluar::with('skpd')
            ->whereMonth('tanggal_surat', $r->bulan)
            ->whereYear('tanggal_surat', $r->tahun)
            ->orderBy('nomor')
            ->get();

        return view('arsip.surat_keluar.preview', compact('items','r'));
    }

    public function exportExcel(Request $r)
    {
        $file = "arsip-surat-keluar-{$r->bulan}-{$r->tahun}.xlsx";
        return Excel::download(new SuratKeluarExport($r->bulan, $r->tahun), $file);
    }

    public function exportPDF(Request $r)
    {
        $items = SuratKeluar::with('skpd')
            ->whereMonth('tanggal_surat', $r->bulan)
            ->whereYear('tanggal_surat', $r->tahun)
            ->orderBy('nomor')
            ->get();

        $pdf = Pdf::loadView('arsip.surat_keluar.pdf', compact('items','r'));
        return $pdf->download("arsip-surat-keluar-{$r->bulan}-{$r->tahun}.pdf");
    }

    public function exportWord(Request $r)
    {
        $items = SuratKeluar::with('skpd')
            ->whereMonth('tanggal_surat', $r->bulan)
            ->whereYear('tanggal_surat', $r->tahun)
            ->orderBy('nomor')
            ->get();

        $phpWord = new PhpWord();
        $sec = $phpWord->addSection();
        $sec->addText(
            "Arsip Surat Keluar Bulan {$r->bulan} Tahun {$r->tahun}",
            ['bold'=>true,'size'=>14]
        );

        $table = $sec->addTable(['borderSize'=>6,'borderColor'=>'999999']);
        // header
        $table->addRow();
        foreach (['No','No Surat','Bidang','Kategori','Tujuan SKPD','Perihal','Tgl Surat','Tgl Kirim'] as $h) {
            $table->addCell(1500)->addText($h, ['bold'=>true]);
        }

        // data
        foreach ($items as $item) {
            $table->addRow();
            $table->addCell(1500)->addText($item->nomor);
            $table->addCell(1500)->addText($item->no_surat);
            $table->addCell(1500)->addText($item->bidang);
            $table->addCell(1500)->addText($item->kategori);
            $table->addCell(1500)->addText($item->skpd->nama ?? '-');
            $table->addCell(1500)->addText($item->perihal);
            $table->addCell(1500)->addText(
                Carbon::parse($item->tanggal_surat)->format('d-m-Y')
            );
            $table->addCell(1500)->addText(
                Carbon::parse($item->tanggal_pengantaran)->format('d-m-Y')
            );
        }

        $tmp = storage_path("arsip-surat-keluar-{$r->bulan}-{$r->tahun}.docx");
        IOFactory::createWriter($phpWord, 'Word2007')->save($tmp);
        return response()
            ->download($tmp)
            ->deleteFileAfterSend(true);
    }
}
