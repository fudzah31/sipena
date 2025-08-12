<?php

namespace App\Http\Controllers;

use App\Models\NotaDinas;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use App\Exports\NotaDinasExport;
use Carbon\Carbon;

class ArsipNotaDinasController extends Controller
{
    public function form()
    {
        return view('arsip.nota_dinas.form');
    }

    public function preview(Request $r)
    {
        // Ambil semua nota dinas, lalu filter progress jika ada
        $q = NotaDinas::with('skpd');

        if ($r->filled('progress')) {
            $q->where('progress', $r->progress);
        }

        $items = $q->orderBy('nomor')->get();

        return view('arsip.nota_dinas.preview', compact('items', 'r'));
    }

    public function exportExcel(Request $r)
    {
        $filename = "arsip-nota-dinas.xlsx";
        return Excel::download(
            new NotaDinasExport($r->progress), 
            $filename
        );
    }

    public function exportPDF(Request $r)
    {
        $q = NotaDinas::with('skpd');
        if ($r->filled('progress')) {
            $q->where('progress', $r->progress);
        }
        $items = $q->orderBy('nomor')->get();

        $pdf = Pdf::loadView('arsip.nota_dinas.pdf', compact('items', 'r'));
        return $pdf->download("arsip-nota-dinas.pdf");
    }

    public function exportWord(Request $r)
    {
        $q = NotaDinas::with('skpd');
        if ($r->filled('progress')) {
            $q->where('progress', $r->progress);
        }
        $items = $q->orderBy('nomor')->get();

        $phpWord = new PhpWord();
        $sec = $phpWord->addSection();
        $title = "Arsip Nota Dinas";
        if ($r->filled('progress')) {
            $title .= " ({$r->progress})";
        }
        $sec->addText($title, ['bold' => true, 'size' => 14]);

        $table = $sec->addTable(['borderSize'=>6, 'borderColor'=>'999999']);
        $header = ['No','Nomor Nota','SKPD','Penerima','Perihal','Progress','Tanggal Buat'];
        $table->addRow();
        foreach ($header as $h) {
            $table->addCell(2000)->addText($h, ['bold'=>true]);
        }

        foreach ($items as $it) {
            $table->addRow();
            $table->addCell(2000)->addText($it->nomor);
            $table->addCell(2000)->addText($it->nomor_nota);
            $table->addCell(2000)->addText($it->skpd->nama ?? '-');
            $table->addCell(2000)->addText($it->penerima);
            $table->addCell(2000)->addText($it->perihal);
            $table->addCell(2000)->addText($it->progress);
            $table->addCell(2000)->addText(Carbon::parse($it->created_at)->format('d-m-Y'));
        }

        $tmp = storage_path("arsip-nota-dinas.docx");
        IOFactory::createWriter($phpWord, 'Word2007')->save($tmp);
        return response()->download($tmp)->deleteFileAfterSend(true);
    }
}
