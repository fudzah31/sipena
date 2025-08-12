<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SuratMasukController extends Controller
{
    private $bidangOptions = [
        'SEKRETARIAT',
        'PENGEMBANGAN KOMPETENSI ASN DAN SUMBER DAYA MANUSIA',
        'MUTASI, PENGADAAN, PENILAIAN DAN EVALUASI KINERJA APARAT',
        'PENGADAAN, PEMBERHENTIAN DAN INFORMASI KEPEGAWAIAN',
    ];

    public function index()
    {
        $items = SuratMasuk::orderBy('tanggal_masuk', 'desc')->get();
        return view('surat_masuk.index', compact('items'));
    }

    public function create()
    {
        return view('surat_masuk.create', [
            'bidangOptions' => $this->bidangOptions,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nomor'               => 'required|integer',
            'no_surat'            => 'required|string|max:255',
            'asal_surat'          => 'nullable|string|max:255',
            'kategori'            => 'nullable|string|max:255',
            'perihal'             => 'nullable|string|max:255',
            'isi_surat'           => 'required|string',
            'file_path'           => 'nullable|file|mimes:pdf,doc,docx',
            'bidang'              => ['required', Rule::in($this->bidangOptions)],
            'keterangan_penerima' => 'required|string|max:255',
            'tanggal_surat'       => 'required|date',
            'tanggal_masuk'       => 'required|date',
        ]);

        if ($file = $request->file('file_path')) {
            $slug = Str::slug($request->no_surat);
            $ext = $file->getClientOriginalExtension();
            $filename = $slug . '.' . $ext;

            $counter = 1;
            while (Storage::exists('public/surat_files/' . $filename)) {
                $filename = $slug . '-' . $counter++ . '.' . $ext;
            }

            $file->storeAs('public/surat_files', $filename);
            $data['file_path'] = 'surat_files/' . $filename;
        }

        SuratMasuk::create($data);

        Alert::success('Berhasil!', 'Surat masuk berhasil disimpan.');
        return redirect()->route('surat-masuk.index');
    }

    public function edit(SuratMasuk $surat_masuk)
    {
        return view('surat_masuk.edit', [
            'surat_masuk'   => $surat_masuk,
            'bidangOptions' => $this->bidangOptions,
        ]);
    }

    public function update(Request $request, SuratMasuk $surat_masuk)
    {
        $data = $request->validate([
            'nomor'               => 'required|integer',
            'no_surat'            => 'required|string|max:255',
            'asal_surat'          => 'nullable|string|max:255',
            'kategori'            => 'nullable|string|max:255',
            'perihal'             => 'nullable|string|max:255',
            'isi_surat'           => 'required|string',
            'file_path'           => 'nullable|file|mimes:pdf,doc,docx',
            'bidang'              => ['required', Rule::in($this->bidangOptions)],
            'keterangan_penerima' => 'required|string|max:255',
            'tanggal_surat'       => 'required|date',
            'tanggal_masuk'       => 'required|date',
        ]);

        if ($file = $request->file('file_path')) {
            $slug = Str::slug($request->no_surat);
            $ext = $file->getClientOriginalExtension();
            $filename = $slug . '.' . $ext;

            $counter = 1;
            while (Storage::exists('public/surat_files/' . $filename)) {
                $filename = $slug . '-' . $counter++ . '.' . $ext;
            }

            $file->storeAs('public/surat_files', $filename);
            $data['file_path'] = 'surat_files/' . $filename;

            if ($surat_masuk->file_path && Storage::exists('public/' . $surat_masuk->file_path)) {
                Storage::delete('public/' . $surat_masuk->file_path);
            }
        }

        $surat_masuk->update($data);

        Alert::success('Berhasil!', 'Surat masuk berhasil diperbarui.');
        return redirect()->route('surat-masuk.index');
    }

    public function destroy(SuratMasuk $surat_masuk)
    {
        if ($surat_masuk->file_path && Storage::exists('public/' . $surat_masuk->file_path)) {
            Storage::delete('public/' . $surat_masuk->file_path);
        }

        $surat_masuk->delete();

        Alert::success('Berhasil!', 'Surat masuk berhasil dihapus.');
        return redirect()->route('surat-masuk.index');
    }

    public function download($id)
    {
        $surat = SuratMasuk::findOrFail($id);

        if (!$surat->file_path || !Storage::exists('public/' . $surat->file_path)) {
            abort(404, 'File tidak ditemukan.');
        }

        $noSurat = str_replace(['/', '\\'], '-', $surat->no_surat);
        $perihal = Str::slug($surat->perihal ?? 'perihal-tidak-ada', '-');
        $extension = pathinfo($surat->file_path, PATHINFO_EXTENSION);

        $newFileName = $noSurat . '-' . $perihal . '.' . $extension;

        return Storage::download('public/' . $surat->file_path, $newFileName);
    }
}
