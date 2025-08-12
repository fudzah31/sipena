@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="card shadow border-0">
    <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #1E3A8A; color: white;">
      <h5 class="mb-0">
        Arsip Surat Masuk: {{ \DateTime::createFromFormat('!m', $r->bulan)->format('F') }} {{ $r->tahun }}
      </h5>
      <a href="{{ route('arsip.surat-masuk.form') }}" class="btn btn-light btn-sm">
        <i class="fa fa-arrow-left me-1"></i> Kembali
      </a>
    </div>

    <div class="card-body">
      <div class="mb-3">
        <a href="{{ route('arsip.surat-masuk.export.excel', $r->only('bulan', 'tahun')) }}" class="btn btn-success btn-sm me-1">
          <i class="fa-solid fa-file-excel me-1"></i> Excel
        </a>
        <a href="{{ route('arsip.surat-masuk.export.pdf', $r->only('bulan', 'tahun')) }}" class="btn btn-danger btn-sm me-1">
          <i class="fa-solid fa-file-pdf me-1"></i> PDF
        </a>
        <a href="{{ route('arsip.surat-masuk.export.word', $r->only('bulan', 'tahun')) }}" class="btn btn-primary btn-sm">
          <i class="fa-solid fa-file-word me-1"></i> Word
        </a>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
          <thead class="table-dark">
            <tr>
              <th>Nomor</th>
              <th>No Surat</th>
              <th>Asal Surat</th>
              <th>Kategori</th>
              <th>Perihal</th>
              <th>Isi Surat</th>
              <th>File</th>
              <th>Bidang</th>
              <th>Keterangan Penerima</th>
              <th>Tanggal Surat</th>
              <th>Tanggal Masuk</th>
            </tr>
          </thead>
          <tbody>
            @forelse($items as $it)
              <tr>
                <td>{{ $it->nomor }}</td>
                <td>{{ $it->no_surat }}</td>
                <td>{{ $it->asal_surat }}</td>
                <td>{{ $it->kategori }}</td>
                <td>{{ $it->perihal }}</td>
                <td>{!! nl2br(e($it->isi_surat)) !!}</td>
                <td>
                  @if($it->file_path)
                    <a href="{{ route('arsip.surat-masuk.download', $it->id) }}" class="btn btn-sm btn-secondary">
                      📎 Unduh
                    </a>
                  @else
                    <span class="text-muted">Tidak ada</span>
                  @endif
                </td>
                <td>{{ $it->bidang }}</td>
                <td>{{ $it->keterangan_penerima }}</td>
                <td>{{ \Carbon\Carbon::parse($it->tanggal_surat)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($it->tanggal_masuk)->format('d/m/Y') }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="11" class="text-center text-muted">
                  Tidak ada data surat masuk pada bulan ini.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
