@extends('layouts.app')

@section('content')
<div class="container">

    {{-- 📨 Form Tambah Surat Masuk --}}
    <div class="form-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-primary fw-bold m-0">➕ Tambah Surat Masuk</h4>
            <a href="{{ route('surat-masuk.index') }}" class="btn btn-kembali">↩ Kembali</a>
        </div>

        <form action="{{ route('surat-masuk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- No. Urut --}}
            <div class="form-group mb-3">
                <label class="form-label fw-bold">No. Urut</label>
                <input type="number" name="nomor" class="form-control @error('nomor') is-invalid @enderror"
                       placeholder="Masukkan nomor urut" value="{{ old('nomor') }}">
                @error('nomor') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- No Surat --}}
            <div class="form-group mb-3">
                <label class="form-label fw-bold">No Surat</label>
                <input type="text" name="no_surat" class="form-control @error('no_surat') is-invalid @enderror"
                       placeholder="Contoh: SM-001/2025" value="{{ old('no_surat') }}">
                @error('no_surat') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Asal Surat --}}
            <div class="form-group mb-3">
                <label class="form-label fw-bold">Asal Surat</label>
                <input type="text" name="asal_surat" class="form-control @error('asal_surat') is-invalid @enderror"
                       placeholder="Contoh: BKN, BKD Provinsi" value="{{ old('asal_surat') }}">
                @error('asal_surat') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Kategori --}}
            <div class="form-group mb-3">
                <label class="form-label fw-bold">Kategori</label>
                <input type="text" name="kategori" class="form-control @error('kategori') is-invalid @enderror"
                       placeholder="Contoh: PEMBERITAHUAN, PERMINTAAN DATA" value="{{ old('kategori') }}">
                @error('kategori') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Perihal --}}
            <div class="form-group mb-3">
                <label class="form-label fw-bold">Perihal</label>
                <input type="text" name="perihal" class="form-control @error('perihal') is-invalid @enderror"
                       placeholder="Contoh: MUTASI PEGAWAI, RAPAT KOORDINASI" value="{{ old('perihal') }}">
                @error('perihal') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Isi Surat --}}
            <div class="form-group mb-3">
                <label class="form-label fw-bold">Isi Surat</label>
                <textarea name="isi_surat" rows="4"
                          class="form-control @error('isi_surat') is-invalid @enderror"
                          placeholder="Contoh: Permohonan data ASN untuk pelaporan tahunan">{{ old('isi_surat') }}</textarea>
                @error('isi_surat') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- File (PDF/Word) --}}
            <div class="form-group mb-3">
                <label class="form-label fw-bold">Upload File Surat (PDF/Word)</label>
                <input type="file" name="file_path" class="form-control @error('file_path') is-invalid @enderror">
                @error('file_path') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Bidang --}}
            <div class="form-group mb-3">
                <label class="form-label fw-bold">Bidang</label>
                <select name="bidang" class="form-control @error('bidang') is-invalid @enderror">
                    <option value="">-- Pilih Bidang --</option>
                    @foreach ($bidangOptions as $b)
                        <option value="{{ $b }}" {{ old('bidang') == $b ? 'selected' : '' }}>
                            {{ $b }}
                        </option>
                    @endforeach
                </select>
                @error('bidang') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Keterangan Penerima --}}
            <div class="form-group mb-3">
                <label class="form-label fw-bold">Keterangan Penerima</label>
                <input type="text" name="keterangan_penerima"
                       class="form-control @error('keterangan_penerima') is-invalid @enderror"
                       placeholder="Contoh: Kepala Bidang Mutasi, Kasubag Kepegawaian"
                       value="{{ old('keterangan_penerima') }}">
                @error('keterangan_penerima') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Tanggal Surat & Masuk --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Tanggal Surat</label>
                    <input type="date" name="tanggal_surat"
                           class="form-control @error('tanggal_surat') is-invalid @enderror"
                           value="{{ old('tanggal_surat') }}">
                    @error('tanggal_surat') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk"
                           class="form-control @error('tanggal_masuk') is-invalid @enderror"
                           value="{{ old('tanggal_masuk') }}">
                    @error('tanggal_masuk') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            {{-- 🎯 Tombol Aksi --}}
            <div class="form-actions">
                <button type="submit" class="btn btn-save">💾 Simpan</button>
                <a href="{{ route('surat-masuk.index') }}" class="btn btn-cancel">❌ Batal</a>
            </div>
        </form>
    </div>
</div>

{{-- ✅ Style --}}
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
    }

    .btn-cancel,
    .btn-kembali {
        background: #6c757d;
        color: white;
        padding: 7px 15px;
        border-radius: 5px;
        text-decoration: none;
    }

    .btn-cancel:hover,
    .btn-kembali:hover {
        opacity: 0.9;
    }
</style>
@endsection
