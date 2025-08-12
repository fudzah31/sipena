@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary fw-bold">📤 Surat Keluar</h2>

        {{-- 🔹 Tombol Kembali ke Beranda --}}
        <a href="{{ url('/') }}" class="btn btn-back">🏠 Beranda</a>
    </div>

    {{-- 🔹 Tombol Tambah Surat Keluar --}}
    <a href="{{ route('surat-keluar.create') }}" class="btn btn-add mb-3">
        ➕ Tambah Surat Keluar
    </a>

    {{-- 🔹 Tabel Surat Keluar --}}
    <div class="table-responsive shadow-sm rounded">
        <table id="suratKeluarTable" class="table table-bordered table-striped table-hover align-middle text-center">
            <thead>
                <tr>
                    <th style="width:5%;">No</th>
                    <th style="width:12%;">No Surat</th>
                    <th style="width:18%;">Bidang</th>
                    <th style="width:10%;">Kategori</th>
                    <th style="width:15%;">Tujuan (SKPD)</th>
                    <th style="width:15%;">Perihal</th>
                    <th style="width:10%;">Tgl Surat</th>
                    <th style="width:10%;">Tgl Pengantaran</th>
                    <th style="width:10%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ $item->nomor }}</td>
                    <td>{{ $item->no_surat }}</td>
                    <td class="text-wrap">{{ $item->bidang }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td>{{ $item->skpd->nama ?? '-' }}</td>
                    <td class="text-wrap">{{ $item->perihal }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_surat)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_pengantaran)->format('d-m-Y') }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('surat-keluar.edit', $item->id) }}" class="btn btn-edit">✏️ Edit</a>
                            <form action="{{ route('surat-keluar.destroy', $item->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="btn btn-delete" onclick="return confirm('Yakin hapus surat ini?')">🗑 Hapus</button>
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
    $('#suratKeluarTable').DataTable({
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

{{-- ✅ CSS Table Center & Proporsional --}}
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
</style>
@endsection
