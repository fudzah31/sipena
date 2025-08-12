@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="card shadow border-0">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0">
        Arsip Nota Dinas
        @if(request('progress'))
          ({{ request('progress') }})
        @endif
      </h5>
      <a href="{{ route('arsip.nota-dinas.form') }}" class="btn btn-light btn-sm">
        <i class="fa fa-arrow-left me-1"></i> Kembali
      </a>
    </div>

    <div class="card-body">
      <div class="mb-3">
        <a href="{{ route('arsip.nota-dinas.export.excel', request()->all()) }}" class="btn btn-success btn-sm me-1">
          <i class="fa-solid fa-file-excel me-1"></i> Excel
        </a>
        <a href="{{ route('arsip.nota-dinas.export.pdf', request()->all()) }}" class="btn btn-danger btn-sm me-1">
          <i class="fa-solid fa-file-pdf me-1"></i> PDF
        </a>
        <a href="{{ route('arsip.nota-dinas.export.word', request()->all()) }}" class="btn btn-primary btn-sm">
          <i class="fa-solid fa-file-word me-1"></i> Word
        </a>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
          <thead class="table-dark">
            <tr>
              <th>No</th>
              <th>Nomor Nota</th>
              <th>SKPD</th>
              <th>Penerima</th>
              <th>Perihal</th>
              <th>Progress</th>
              <th>Tanggal Buat</th>
            </tr>
          </thead>
          <tbody>
            @forelse($items as $it)
            <tr>
              <td>{{ $it->nomor }}</td>
              <td>{{ $it->nomor_nota }}</td>
              <td>{{ $it->skpd->nama ?? '-' }}</td>
              <td>{{ $it->penerima }}</td>
              <td>{{ $it->perihal }}</td>
              <td>{{ $it->progress }}</td>
              <td>{{ \Carbon\Carbon::parse($it->created_at)->format('d-m-Y') }}</td>
            </tr>
            @empty
            <tr>
              <td colspan="7" class="text-center text-muted">Tidak ada Nota Dinas.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
