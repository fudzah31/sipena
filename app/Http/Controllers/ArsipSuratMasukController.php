<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\SuratMasukExport;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Support\Facades\Storage;

class ArsipSuratMasukController extends Controller
{
    // 1) Tampilkan form filter
    public function form()
    {
        return view('arsip.surat_masuk.form');
    }

    // 2) Preview hasil filter
    public function preview(Request $r)
    {
        $items = SuratMasuk::whereMonth('tanggal_surat', $r->bulan)
            ->whereYear('tanggal_surat', $r->tahun)
            ->orderBy('tanggal_masuk', 'desc')
            ->get();

        return view('arsip.surat_masuk.preview', compact('items', 'r'));
    }

    // 3) Export ke Excel
    public function exportExcel(Request $r)
    {
        $file = "arsip-surat-masuk-{$r->bulan}-{$r->tahun}.xlsx";
        return Excel::download(new SuratMasukExport($r->bulan, $r->tahun), $file);
    }

    // 4) Export ke PDF
    public function exportPDF(Request $r)
    {
        $items = SuratMasuk::whereMonth('tanggal_surat', $r->bulan)
            ->whereYear('tanggal_surat', $r->tahun)
            ->orderBy('tanggal_masuk', 'desc')
            ->get();

        $pdf = Pdf::loadView('arsip.surat_masuk.pdf', compact('items', 'r'));
        return $pdf->download("arsip-surat-masuk-{$r->bulan}-{$r->tahun}.pdf");
    }

    // 5) Export ke Word
    public function exportWord(Request $r)
    {
        $items = SuratMasuk::whereMonth('tanggal_surat', $r->bulan)
            ->whereYear('tanggal_surat', $r->tahun)
            ->orderBy('tanggal_masuk', 'desc')
            ->get();

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $section->addText("📁 Arsip Surat Masuk Bulan {$r->bulan} Tahun {$r->tahun}", ['bold' => true, 'size' => 14], ['alignment' => 'center']);

        $table = $section->addTable([
            'borderSize' => 6,
            'borderColor' => '999999',
            'cellMargin' => 80,
        ]);

        // Header (tanpa "No")
        $headers = [
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

        $table->addRow();
        foreach ($headers as $header) {
            $table->addCell(2000)->addText($header, ['bold' => true]);
        }

        // Data
        foreach ($items as $it) {
            $table->addRow();
            $table->addCell(1500)->addText($it->nomor);
            $table->addCell(2500)->addText($it->no_surat);
            $table->addCell(2500)->addText($it->asal_surat);
            $table->addCell(2500)->addText($it->kategori);
            $table->addCell(2500)->addText($it->perihal);
            $table->addCell(3500)->addText(strip_tags($it->isi_surat));
            $table->addCell(2500)->addText($it->file_path ? 'Ada File' : '-');
            $table->addCell(2500)->addText($it->bidang);
            $table->addCell(2500)->addText($it->keterangan_penerima);
            $table->addCell(2000)->addText($it->tanggal_surat);
            $table->addCell(2000)->addText($it->tanggal_masuk);
        }

        $tmp = storage_path("arsip-surat-masuk-{$r->bulan}-{$r->tahun}.docx");
        IOFactory::createWriter($phpWord, 'Word2007')->save($tmp);

        return response()->download($tmp)->deleteFileAfterSend(true);
    }

    // 6) Download file asli dari storage
    public function download($id)
    {
        $surat = SuratMasuk::findOrFail($id);

        if (!$surat->file_path) {
            return abort(404, 'File tidak ditemukan.');
        }

        // Ambil path lengkap file
        $file = storage_path('app/public/' . $surat->file_path);

        // Cek apakah file beneran ada
        if (!file_exists($file)) {
            return abort(404, 'File tidak ditemukan di penyimpanan.');
        }

        return response()->download($file);
    }
}
