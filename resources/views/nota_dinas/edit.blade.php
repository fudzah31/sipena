@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form-card shadow">
        {{-- 🔹 Judul --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-primary fw-bold m-0">✏️ Edit Nota Dinas</h4>
            <a href="{{ route('nota-dinas.index') }}" class="btn btn-kembali">↩ Kembali</a>
        </div>

        <form action="{{ route('nota-dinas.update', $nota->id) }}" method="POST">
            @csrf @method('PUT')

            {{-- ✅ Nomor urut --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Nomor</label>
                <input type="text" name="nomor" class="form-control" placeholder="Masukkan nomor urut" value="{{ old('nomor', $nota->nomor) }}">
                @error('nomor') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- ✅ Nomor nota resmi --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Nomor Nota Dinas</label>
                <input type="text" name="nomor_nota" class="form-control" placeholder="Contoh: 800/001/ND/2025" value="{{ old('nomor_nota', $nota->nomor_nota) }}">
                @error('nomor_nota') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- 🔄 SKPD --}}
            <div class="mb-3">
                <label class="form-label fw-bold">SKPD</label>
                <input list="skpd_list" name="skpd_nama" class="form-control" placeholder="Ketik atau pilih SKPD"
                    value="{{ old('skpd_nama', $nota->skpd->nama ?? '') }}">
                <datalist id="skpd_list">
                    @foreach($skpds as $skpd)
                        <option value="{{ $skpd->nama }}">
                    @endforeach
                </datalist>
                @error('skpd_nama') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- ✅ Penerima --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Penerima</label>
                <input type="text" name="penerima" class="form-control" placeholder="Masukkan nama penerima" value="{{ old('penerima', $nota->penerima) }}">
                @error('penerima') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- ✅ Perihal --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Perihal</label>
                <input type="text" name="perihal" class="form-control" placeholder="Masukkan perihal" value="{{ old('perihal', $nota->perihal) }}">
                @error('perihal') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- ✅ Progress Dropdown --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Progress</label>
                <select name="progress" class="form-control">
                    @php
                        $statuses = [
                            'DIKIRIM',
                            'DALAM PERJALANAN',
                            'DITERIMA INSTANSI TUJUAN',
                            'SELESAI',
                            'DIBATALKAN'
                        ];
                    @endphp
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" {{ old('progress', $nota->progress) == $status ? 'selected' : '' }}>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
                @error('progress') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- ✅ Tombol --}}
            <div class="d-flex justify-content-center gap-2 mt-4">
                <button type="submit" class="btn btn-primary px-4">💾 Update</button>
                <a href="{{ route('nota-dinas.index') }}" class="btn btn-secondary px-4">❌ Batal</a>
            </div>
        </form>
    </div>
</div>

{{-- ✅ CSS Selaras --}}
<style>
    body {
        background: #f7f9fc;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .form-card {
        max-width: 650px;
        margin: 0 auto;
        background: white;
        padding: 25px 30px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        border-top: 4px solid #2f80ed;
    }
    label {
        font-weight: 600;
        color: #333;
    }
    .form-control, .form-select {
        border-radius: 5px;
        border: 1px solid #d1d1d1;
        padding: 10px;
        font-size: 14px;
    }
    .form-control:focus, .form-select:focus {
        border-color: #2f80ed;
        box-shadow: 0 0 4px rgba(47,128,237,0.3);
    }
    .btn-primary {
        background: #2f80ed;
        border: none;
        font-weight: bold;
    }
    .btn-primary:hover {
        background: #1c5ec9;
    }
    .btn-secondary {
        background: #6c757d;
        border: none;
        font-weight: bold;
    }
    .btn-secondary:hover {
        background: #495057;
    }
    .btn-kembali {
        background-color: #6c757d;
        color: white;
        font-weight: bold;
        padding: 7px 15px;
        border-radius: 5px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: background 0.2s ease;
    }
    .btn-kembali:hover {
        background-color: #555b62;
    }
</style>
@endsection
