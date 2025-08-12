@extends('layouts.app')

@section('content')
<div class="container">

    {{-- 🔹 Header Halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary fw-bold">📄 Nota Dinas</h2>
        <a href="{{ url('/') }}" class="btn btn-back">🏠 Beranda</a>
    </div>

    {{-- 🔹 Tombol Tambah Nota --}}
    <a href="{{ route('nota-dinas.create') }}" class="btn btn-add mb-3">
        ➕ Tambah Nota Dinas
    </a>

    {{-- 🔹 Tabel Nota Dinas --}}
    <div class="table-responsive shadow-sm rounded">
        <table id="notaTable" class="table table-bordered table-striped table-hover align-middle text-center">
            <thead>
                <tr>
                    <th>No</th>
                   
                    <th>Nomor Nota</th>
                    <th>SKPD</th>
                    <th>Penerima</th>
                    <th>Perihal</th>
                    <th>Progress</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $nota)
                <tr>
                   
                    <td>{{ $nota->nomor }}</td>
                    <td>{{ $nota->nomor_nota }}</td>
                    <td>{{ $nota->skpd->nama ?? '-' }}</td>
                    <td class="text-wrap">{{ $nota->penerima }}</td>
                    <td class="text-wrap">{{ $nota->perihal }}</td>
                    <td>
                        <span class="badge bg-progress-{{ Str::slug($nota->progress, '_') }}">
                            {{ $nota->progress }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('nota-dinas.edit', $nota->id) }}" class="btn btn-edit">✏️ Edit</a>
                            <form action="{{ route('nota-dinas.destroy', $nota->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="btn btn-delete" onclick="return confirm('Yakin hapus?')">🗑 Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- ✅ DataTables --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#notaTable').DataTable({
        "pageLength": 10,
        "autoWidth": false,
        "language": {
            "search": "🔍 Cari:",
            "lengthMenu": "Tampilkan _MENU_ data",
            "info": "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            "infoEmpty": "Tidak ada data",
            "zeroRecords": "Data tidak ditemukan",
            "infoFiltered": "(disaring dari _MAX_ total data)"
        }
    });
});
</script>

{{-- ✅ CSS --}}
<style>
    table.dataTable thead th {
        background: #2f80ed;
        color: white;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 13px;
        text-align: center;
    }
    td, th {
        text-align: center;
        vertical-align: middle;
        padding: 10px 5px;
        font-size: 14px;
    }
    .text-wrap {
        white-space: normal !important;
        word-wrap: break-word;
        max-width: 200px;
    }
    .dataTables_filter {
        margin-bottom: 15px;
    }
    .btn-add {
        background:#2f80ed;
        color:white;
        padding:7px 15px;
        border-radius:5px;
        font-weight:bold;
    }
    .btn-add:hover { background:#1c5ec9; }
    .btn-back {
        background:#6c757d;
        color:white;
        padding:7px 15px;
        border-radius:5px;
        font-weight:bold;
    }
    .btn-back:hover { background:#495057; }
    .btn-edit {
        background:#27ae60;
        color:white;
        padding:5px 10px;
        border-radius:4px;
        font-size:13px;
    }
    .btn-edit:hover { background:#1e874b; }
    .btn-delete {
        background:#e74c3c;
        color:white;
        padding:5px 10px;
        border:none;
        border-radius:4px;
        font-size:13px;
    }
    .btn-delete:hover { background:#c0392b; }

    /* 🎯 Badge progress style */
    .bg-progress-dikirim { background: #3498db; color: white; }
    .bg-progress-dalam_perjalanan { background: #f39c12; color: white; }
    .bg-progress-diterima_instansi_tujuan { background: #8e44ad; color: white; }
    .bg-progress-selesai { background: #27ae60; color: white; }
    .bg-progress-dibatalkan { background: #e74c3c; color: white; }

    .badge {
        padding: 5px 10px;
        font-size: 12px;
        border-radius: 15px;
        font-weight: 500;
    }
</style>
@endsection
