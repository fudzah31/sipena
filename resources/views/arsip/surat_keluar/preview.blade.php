@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="card shadow border-0">
    <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #1E3A8A; color: white;">
      <h5 class="mb-0">
        Arsip Surat Keluar: {{ DateTime::createFromFormat('!m', $r->bulan)->format('F') }} {{ $r->tahun }}
      </h5>
      <a href="{{ route('arsip.surat-keluar.form') }}" class="btn btn-light btn-sm">
        <i class="fa fa-arrow-left me-1"></i> Kembali
      </a>
    </div>

    <div class="card-body">
      <div class="mb-3">
        <a href="{{ route('arsip.surat-keluar.export.excel', ['bulan' => $r->bulan, 'tahun' => $r->tahun]) }}" class="btn btn-success btn-sm me-1">
          <i class="fa-solid fa-file-excel me-1"></i> Excel
        </a>
        <a href="{{ route('arsip.surat-keluar.export.pdf', ['bulan' => $r->bulan, 'tahun' => $r->tahun]) }}" class="btn btn-danger btn-sm me-1">
          <i class="fa-solid fa-file-pdf me-1"></i> PDF
        </a>
        <a href="{{ route('arsip.surat-keluar.export.word', ['bulan' => $r->bulan, 'tahun' => $r->tahun]) }}" class="btn btn-primary btn-sm">
          <i class="fa-solid fa-file-word me-1"></i> Word
        </a>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
          <thead class="table-dark">
            <tr>
              <th>No</th>
              <th>No Surat</th>
              <th>Bidang</th>
              <th>Kategori</th>
              <th>SKPD</th>
              <th>Perihal</th>
              <th>Tgl Surat</th>
              <th>Tgl Kirim</th>
            </tr>
          </thead>
          <tbody>
            @forelse($items as $it)
              <tr>
                {{-- Kolom No sekarang dari field nomor --}}
                <td>{{ $it->nomor }}</td>
                <td>{{ $it->no_surat }}</td>
                <td>{{ $it->bidang }}</td>
                <td>{{ $it->kategori }}</td>
                <td>{{ $it->skpd->nama ?? '-' }}</td>
                <td>{{ $it->perihal }}</td>
                <td>{{ \Carbon\Carbon::parse($it->tanggal_surat)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($it->tanggal_pengantaran)->format('d-m-Y') }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="text-center text-muted">Tidak ada data surat keluar pada bulan ini.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
