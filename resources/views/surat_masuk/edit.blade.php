@extends('layouts.app')

@section('content')
<div class="container">

    {{-- ✏️ Card Form Edit --}}
    <div class="form-card shadow">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-primary fw-bold m-0">✏️ Edit Surat Masuk</h4>
            <a href="{{ route('surat-masuk.index') }}" class="btn btn-kembali">↩ Kembali</a>
        </div>

        <form action="{{ route('surat-masuk.update', $surat_masuk->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            {{-- No. Urut --}}
            <div class="mb-3">
                <label class="form-label fw-bold">No. Urut</label>
                <input type="number" name="nomor" class="form-control" placeholder="Masukkan no urut"
                    value="{{ old('nomor', $surat_masuk->nomor) }}">
                @error('nomor') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- No Surat --}}
            <div class="mb-3">
                <label class="form-label fw-bold">No Surat</label>
                <input type="text" name="no_surat" class="form-control" placeholder="Masukkan nomor surat"
                    value="{{ old('no_surat', $surat_masuk->no_surat) }}">
                @error('no_surat') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Asal Surat --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Asal Surat</label>
                <input type="text" name="asal_surat" class="form-control" placeholder="Masukkan asal surat"
                    value="{{ old('asal_surat', $surat_masuk->asal_surat) }}">
                @error('asal_surat') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Kategori --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Kategori</label>
                <input type="text" name="kategori" class="form-control" placeholder="Kategori surat"
                    value="{{ old('kategori', $surat_masuk->kategori) }}">
                @error('kategori') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Perihal --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Perihal</label>
                <input type="text" name="perihal" class="form-control" placeholder="Perihal surat"
                    value="{{ old('perihal', $surat_masuk->perihal) }}">
                @error('perihal') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Isi Surat --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Isi Surat</label>
                <textarea name="isi_surat" class="form-control" rows="4"
                    placeholder="Tuliskan isi surat...">{{ old('isi_surat', $surat_masuk->isi_surat) }}</textarea>
                @error('isi_surat') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- File (PDF/Word) --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Upload Ulang File (PDF/Word)</label>
                <input type="file" name="file_path" class="form-control">
                @error('file_path') <small class="text-danger">{{ $message }}</small> @enderror

                @if($surat_masuk->file_path)
                    <div class="mt-2">
                        📎 File Sebelumnya:
                        <a href="{{ asset('storage/' . $surat_masuk->file_path) }}" target="_blank" class="text-primary">
                            {{ basename($surat_masuk->file_path) }}
                        </a>
                    </div>
                @endif
            </div>

            {{-- Bidang --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Bidang</label>
                <select name="bidang" class="form-select">
                    <option value="">-- Pilih Bidang --</option>
                    @foreach($bidangOptions as $bidang)
                        <option value="{{ $bidang }}" {{ (old('bidang', $surat_masuk->bidang) == $bidang) ? 'selected' : '' }}>
                            {{ $bidang }}
                        </option>
                    @endforeach
                </select>
                @error('bidang') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Keterangan Penerima --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Keterangan Penerima</label>
                <input type="text" name="keterangan_penerima" class="form-control"
                    placeholder="Masukkan keterangan penerima"
                    value="{{ old('keterangan_penerima', $surat_masuk->keterangan_penerima) }}">
                @error('keterangan_penerima') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Tanggal Surat & Masuk --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Tanggal Surat</label>
                    <input type="date" name="tanggal_surat" class="form-control"
                        value="{{ old('tanggal_surat', $surat_masuk->tanggal_surat) }}">
                    @error('tanggal_surat') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" class="form-control"
                        value="{{ old('tanggal_masuk', $surat_masuk->tanggal_masuk) }}">
                    @error('tanggal_masuk') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            {{-- 🔘 Tombol --}}
            <div class="d-flex justify-content-end gap-2 mt-4">
                <button type="submit" class="btn btn-primary px-4">💾 Update</button>
                <a href="{{ route('surat-masuk.index') }}" class="btn btn-secondary px-4">❌ Batal</a>
            </div>
        </form>
    </div>
</div>

{{-- ✅ CSS Selaras --}}
<style>
    .form-card {
        max-width: 750px;
        margin: 30px auto;
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
