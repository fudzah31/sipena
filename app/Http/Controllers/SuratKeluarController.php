<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use App\Models\Skpd;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class SuratKeluarController extends Controller
{
    public function index()
    {
        $items = SuratKeluar::with('skpd')->orderBy('tanggal_surat', 'desc')->get();
        return view('surat_keluar.index', compact('items'));
    }

    public function create()
    {
        $bidangs = $this->bidangOptions();
        return view('surat_keluar.create', compact('bidangs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nomor'               => 'required|integer', // ✅ Tambahkan input nomor manual
            'no_surat'            => 'required|string|max:255',
            'bidang'              => ['required', 'string', Rule::in($this->bidangOptions())],
            'kategori'            => 'required|string|max:255',
            'skpd_nama'           => 'required|string|max:255',
            'perihal'             => 'required|string|max:255',
            'tanggal_surat'       => 'required|date',
            'tanggal_pengantaran' => 'required|date',
        ]);

        $skpd = Skpd::firstOrCreate(['nama' => $data['skpd_nama']]);

        SuratKeluar::create([
            'nomor'               => $data['nomor'],
            'no_surat'            => $data['no_surat'],
            'bidang'              => $data['bidang'],
            'kategori'            => $data['kategori'],
            'skpd_id'             => $skpd->id,
            'perihal'             => $data['perihal'],
            'tanggal_surat'       => $data['tanggal_surat'],
            'tanggal_pengantaran' => $data['tanggal_pengantaran'],
        ]);

        Alert::success('Berhasil!', 'Data surat keluar berhasil disimpan.');
        return redirect()->route('surat-keluar.index');
    }

    public function edit(string $id)
    {
        $item = SuratKeluar::with('skpd')->findOrFail($id);
        $bidangs = $this->bidangOptions();
        return view('surat_keluar.edit', compact('item', 'bidangs'));
    }

    public function update(Request $request, string $id)
    {
        $item = SuratKeluar::findOrFail($id);

        $data = $request->validate([
            'nomor'               => 'required|integer', // ✅ validasi juga di edit
            'no_surat'            => 'required|string|max:255',
            'bidang'              => ['required', 'string', Rule::in($this->bidangOptions())],
            'kategori'            => 'required|string|max:255',
            'skpd_nama'           => 'required|string|max:255',
            'perihal'             => 'required|string|max:255',
            'tanggal_surat'       => 'required|date',
            'tanggal_pengantaran' => 'required|date',
        ]);

        $skpd = Skpd::firstOrCreate(['nama' => $data['skpd_nama']]);

        $item->update([
            'nomor'               => $data['nomor'],
            'no_surat'            => $data['no_surat'],
            'bidang'              => $data['bidang'],
            'kategori'            => $data['kategori'],
            'skpd_id'             => $skpd->id,
            'perihal'             => $data['perihal'],
            'tanggal_surat'       => $data['tanggal_surat'],
            'tanggal_pengantaran' => $data['tanggal_pengantaran'],
        ]);

        Alert::success('Berhasil!', 'Data surat keluar berhasil diperbarui.');
        return redirect()->route('surat-keluar.index');
    }

    public function destroy(string $id)
    {
        SuratKeluar::findOrFail($id)->delete();
        Alert::success('Berhasil!', 'Data surat keluar berhasil dihapus.');
        return redirect()->route('surat-keluar.index');
    }

    private function bidangOptions()
    {
        return [
            'SEKRETARIAT',
            'PENGEMBANGAN KOMPETENSI ASN DAN SUMBER DAYA MANUSIA',
            'MUTASI, PENGADAAN, PENILAIAN DAN EVALUASI KINERJA APARATUR',
            'PENGADAAN, PEMBERHENTIAN DAN INFORMASI KEPEGAWAIAN',
        ];
    }
}
