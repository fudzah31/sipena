<?php

namespace App\Http\Controllers;

use App\Models\NotaDinas;
use App\Models\Skpd;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class NotaDinasController extends Controller
{
    public function index()
    {
        $data = NotaDinas::with('skpd')->orderBy('created_at', 'desc')->get();
        return view('nota_dinas.index', compact('data'));
    }

    public function create()
    {
        $skpds = Skpd::orderBy('nama')->get();
        $progressOptions = ['DIKIRIM', 'DALAM PERJALANAN', 'DITERIMA INSTANSI TUJUAN', 'SELESAI', 'DIBATALKAN'];
        return view('nota_dinas.create', compact('skpds', 'progressOptions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor'        => 'required|string|max:255',
            'nomor_nota'   => 'required|string|max:255',
            'skpd_nama'    => 'required|string|max:255',
            'penerima'     => 'required|string|max:255',
            'perihal'      => 'required|string|max:255',
            'progress'     => 'required|in:DIKIRIM,DALAM PERJALANAN,DITERIMA INSTANSI TUJUAN,SELESAI,DIBATALKAN',
        ]);

        // Cari atau buat SKPD berdasarkan nama
        $skpd = Skpd::firstOrCreate(['nama' => $request->skpd_nama]);

        NotaDinas::create([
            'nomor'        => $request->nomor,
            'nomor_nota'   => $request->nomor_nota,
            'skpd_id'      => $skpd->id,
            'penerima'     => $request->penerima,
            'perihal'      => $request->perihal,
            'progress'     => strtoupper($request->progress),
        ]);

        Alert::success('Berhasil!', 'Nota Dinas berhasil ditambahkan.');
        return redirect()->route('nota-dinas.index');
    }

    public function edit($id)
    {
        $nota = NotaDinas::with('skpd')->findOrFail($id);
        $skpds = Skpd::orderBy('nama')->get();
        $progressOptions = ['DIKIRIM', 'DALAM PERJALANAN', 'DITERIMA INSTANSI TUJUAN', 'SELESAI', 'DIBATALKAN'];
        return view('nota_dinas.edit', compact('nota', 'skpds', 'progressOptions'));
    }

    public function update(Request $request, $id)
    {
        $nota = NotaDinas::findOrFail($id);

        $request->validate([
            'nomor'        => 'required|string|max:255',
            'nomor_nota'   => 'required|string|max:255',
            'skpd_nama'    => 'required|string|max:255',
            'penerima'     => 'required|string|max:255',
            'perihal'      => 'required|string|max:255',
            'progress'     => 'required|in:DIKIRIM,DALAM PERJALANAN,DITERIMA INSTANSI TUJUAN,SELESAI,DIBATALKAN',
        ]);

        $skpd = Skpd::firstOrCreate(['nama' => $request->skpd_nama]);

        $nota->update([
            'nomor'        => $request->nomor,
            'nomor_nota'   => $request->nomor_nota,
            'skpd_id'      => $skpd->id,
            'penerima'     => $request->penerima,
            'perihal'      => $request->perihal,
            'progress'     => strtoupper($request->progress),
        ]);

        Alert::success('Berhasil!', 'Nota Dinas berhasil diperbarui.');
        return redirect()->route('nota-dinas.index');
    }

    public function destroy($id)
    {
        NotaDinas::destroy($id);

        Alert::success('Berhasil!', 'Nota Dinas berhasil dihapus.');
        return redirect()->route('nota-dinas.index');
    }
}
