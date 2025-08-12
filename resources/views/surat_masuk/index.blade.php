@extends('layouts.app')

@section('content')
<div class="container-fluid">

    {{-- 🔹 Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary fw-bold">📥 Surat Masuk</h2>
        <a href="{{ url('/') }}" class="btn btn-back">🏠 Beranda</a>
    </div>

    {{-- 🔹 Tombol Tambah --}}
    <a href="{{ route('surat-masuk.create') }}" class="btn btn-add mb-3">➕ Tambah Surat Masuk</a>

    {{-- 🔹 Tabel --}}
    <div class="table-responsive shadow-sm rounded">
        <table id="suratTable" class="table table-bordered table-striped table-hover align-middle text-nowrap">
            <thead class="table-primary text-center">
                <tr>
                    <th>No Urut</th>
                    <th>No Surat</th>
                    <th>Asal Surat</th>
                    <th>Kategori</th>
                    <th>Perihal</th>
                    <th>Isi Surat</th>
                    <th>File</th>
                    <th>Bidang</th>
                    <th>Penerima</th>
                    <th>Tanggal Surat</th>
                    <th>Tanggal Masuk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ $item->nomor }}</td>
                    <td>{{ $item->no_surat }}</td>
                    <td>{{ $item->asal_surat }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td>{{ $item->perihal }}</td>
                    <td style="white-space: normal;">{{ $item->isi_surat }}</td>
                    <td>
                        @if($item->file_path && file_exists(public_path('storage/' . $item->file_path)))
                            <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank" class="btn btn-sm btn-secondary">
                                📄 Lihat
                            </a>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td style="white-space: normal;">{{ $item->bidang }}</td>
                    <td style="white-space: normal;">{{ $item->keterangan_penerima }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_surat)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d-m-Y') }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('surat-masuk.edit', $item->id) }}" class="btn btn-edit">✏️ Edit</a>
                            <form action="{{ route('surat-masuk.destroy', $item->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-delete" onclick="return confirm('Yakin hapus?')">🗑 Hapus</button>
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
    $('#suratTable').DataTable({
        scrollX: true,
        pageLength: 10,
        autoWidth: false,
        language: {
            search: "🔍 Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            infoEmpty: "Tidak ada data",
            zeroRecords: "Data tidak ditemukan",
            infoFiltered: "(disaring dari _MAX_ total data)"
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
        white-space: nowrap;
    }

    td, th {
        text-align: center;
        vertical-align: middle;
        padding: 10px 8px;
        font-size: 14px;
    }

    .btn-add {
        background: #2f80ed;
        color: white;
        padding: 7px 15px;
        border-radius: 5px;
        font-weight: bold;
    }

    .btn-add:hover {
        background: #1c5ec9;
    }

    .btn-back {
        background: #6c757d;
        color: white;
        padding: 7px 15px;
        border-radius: 5px;
        font-weight: bold;
    }

    .btn-back:hover {
        background: #495057;
    }

    .btn-edit {
        background: #27ae60;
        color: white;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 13px;
    }

    .btn-edit:hover {
        background: #1e874b;
    }

    .btn-delete {
        background: #e74c3c;
        color: white;
        padding: 5px 10px;
        border: none;
        border-radius: 4px;
        font-size: 13px;
    }

    .btn-delete:hover {
        background: #c0392b;
    }

    .table-responsive {
        overflow-x: auto;
        min-height: 400px;
    }

    td {
        white-space: normal !important;
        word-wrap: break-word;
    }

    div.dataTables_filter {
        margin-bottom: 15px;
        margin-top: 10px;
    }
</style>
@endsection
