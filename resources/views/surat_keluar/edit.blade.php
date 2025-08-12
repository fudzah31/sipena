@extends('layouts.app')

@section('content')
<div class="container">

    {{-- 📝 Form Edit Surat Keluar --}}
    <div class="form-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="form-title m-0">✏️ Edit Surat Keluar</h2>
            <a href="{{ route('surat-keluar.index') }}" class="btn btn-kembali">↩ Kembali</a>
        </div>

        <form action="{{ route('surat-keluar.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- ✅ Tambahan: Input Nomor --}}
            <div class="form-group mb-3">
                <label>Nomor</label>
                <input type="number" name="nomor" class="form-control" placeholder="Masukkan nomor urut" value="{{ old('nomor', $item->nomor) }}">
                @error('nomor') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group mb-3">
                <label>No Surat</label>
                <input type="text" name="no_surat" class="form-control" placeholder="Masukkan nomor surat" value="{{ old('no_surat', $item->no_surat) }}">
                @error('no_surat') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group mb-3">
                <label>Bidang</label>
                <select name="bidang" class="form-control">
                    @foreach($bidangs as $bid)
                        <option value="{{ $bid }}" {{ old('bidang', $item->bidang) == $bid ? 'selected' : '' }}>{{ $bid }}</option>
                    @endforeach
                </select>
                @error('bidang') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group mb-3">
                <label>Kategori</label>
                <input type="text" name="kategori" class="form-control" placeholder="Masukkan kategori" value="{{ old('kategori', $item->kategori) }}">
                @error('kategori') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- ✨ Tujuan bisa diketik atau dipilih --}}
            <div class="form-group mb-3">
                <label>Tujuan (SKPD)</label>
                <input list="skpd_list" name="skpd_nama" class="form-control" placeholder="Ketik atau pilih SKPD"
                       value="{{ old('skpd_nama', $item->skpd->nama ?? '') }}">
                <datalist id="skpd_list">
                    @foreach(App\Models\Skpd::orderBy('nama')->get() as $skpd)
                        <option value="{{ $skpd->nama }}">
                    @endforeach
                </datalist>
                @error('skpd_nama') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group mb-3">
                <label>Perihal</label>
                <input type="text" name="perihal" class="form-control" placeholder="Tuliskan perihal" value="{{ old('perihal', $item->perihal) }}">
                @error('perihal') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Tanggal Surat</label>
                    <input type="date" name="tanggal_surat" class="form-control" value="{{ old('tanggal_surat', $item->tanggal_surat) }}">
                    @error('tanggal_surat') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label>Tanggal Pengantaran</label>
                    <input type="date" name="tanggal_pengantaran" class="form-control" value="{{ old('tanggal_pengantaran', $item->tanggal_pengantaran) }}">
                    @error('tanggal_pengantaran') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            {{-- 🎯 Tombol Aksi --}}
            <div class="form-actions">
                <button type="submit" class="btn btn-save">💾 Update</button>
                <a href="{{ route('surat-keluar.index') }}" class="btn btn-cancel">❌ Batal</a>
            </div>
        </form>
    </div>
</div>

{{-- 🌈 Style --}}
<style>
    body {
        background: #f7f9fc;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .form-card {
        max-width: 650px;
        margin: 30px auto;
        background: white;
        padding: 25px 30px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        border-top: 4px solid #2f80ed;
    }
    .form-title {
        font-size: 22px;
        font-weight: bold;
        color: #2f80ed;
    }
    label {
        font-weight: 600;
        color: #333;
    }
    .form-control {
        border-radius: 5px;
        border: 1px solid #d1d1d1;
        padding: 10px;
        font-size: 14px;
    }
    .form-control:focus {
        border-color: #2f80ed;
        box-shadow: 0 0 4px rgba(47,128,237,0.3);
    }
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 20px;
    }
    .btn-save {
        background: #27ae60;
        color: white;
        padding: 8px 16px;
        border-radius: 5px;
        border: none;
        transition: 0.3s;
    }
    .btn-save:hover {
        background: #1e874b;
    }
    .btn-cancel {
        background: #6c757d;
        color: white;
        padding: 8px 16px;
        border-radius: 5px;
        text-decoration: none;
        transition: 0.3s;
    }
    .btn-cancel:hover {
        background: #555b62;
    }
    .btn-kembali {
        background: #6c757d;
        color: white;
        font-weight: bold;
        padding: 7px 15px;
        border-radius: 5px;
        text-decoration: none;
        transition: 0.3s;
    }
    .btn-kembali:hover {
        background: #555b62;
    }
    .btn-secondary {
        background-color: #2f80ed;
        color: white;
        padding: 6px 12px;
        border-radius: 5px;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
    }
    .btn-secondary:hover {
        background-color: #1c5db8;
    }
</style>
@endsection
