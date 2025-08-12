@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="form-title m-0">📝 Buat Nota Dinas</h2>
            <a href="{{ route('nota-dinas.index') }}" class="btn btn-kembali">↩ Kembali</a>
        </div>

        <form action="{{ route('nota-dinas.store') }}" method="POST">
            @csrf

            {{-- ✅ Nomor urut manual --}}
            <div class="form-group mb-3">
                <label for="nomor">Nomor</label>
                <input type="text" name="nomor" id="nomor" class="form-control" placeholder="Misal: 1, 2, dst" value="{{ old('nomor') }}">
                @error('nomor') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- ✅ Nomor Nota Dinas resmi --}}
            <div class="form-group mb-3">
                <label for="nomor_nota">Nomor Nota Dinas</label>
                <input type="text" name="nomor_nota" id="nomor_nota" class="form-control" placeholder="Misal: 800/001/ND/2025" value="{{ old('nomor_nota') }}">
                @error('nomor_nota') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- ✅ Tujuan SKPD --}}
            <div class="form-group mb-3">
                <label for="skpd_nama">Tujuan SKPD</label>
                <input list="skpd_list" name="skpd_nama" id="skpd_nama" class="form-control" placeholder="Ketik atau pilih SKPD" value="{{ old('skpd_nama') }}">
                <datalist id="skpd_list">
                    @foreach(App\Models\Skpd::orderBy('nama')->get() as $skpd)
                        <option value="{{ $skpd->nama }}">
                    @endforeach
                </datalist>
                @error('skpd_nama') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- ✅ Penerima --}}
            <div class="form-group mb-3">
                <label for="penerima">Penerima</label>
                <input type="text" name="penerima" id="penerima" class="form-control" placeholder="Masukkan nama penerima" value="{{ old('penerima') }}">
                @error('penerima') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- ✅ Perihal --}}
            <div class="form-group mb-3">
                <label for="perihal">Perihal</label>
                <input type="text" name="perihal" id="perihal" class="form-control" placeholder="Tuliskan perihal" value="{{ old('perihal') }}">
                @error('perihal') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- ✅ Dropdown progress --}}
            <div class="form-group mb-3">
                <label for="progress">Progress</label>
                <select name="progress" id="progress" class="form-control">
                    <option value="">-- Pilih Status Progress --</option>
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
                        <option value="{{ $status }}" {{ old('progress') == $status ? 'selected' : '' }}>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
                @error('progress') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- ✅ Tombol --}}
            <div class="form-actions">
                <button type="submit" class="btn btn-save">💾 Simpan</button>
                <a href="{{ route('nota-dinas.index') }}" class="btn btn-cancel">❌ Batal</a>
            </div>
        </form>
    </div>
</div>

{{-- ✅ Style --}}
<style>
    .form-card {
        max-width: 700px;
        margin: 30px auto;
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        border-top: 5px solid #2f80ed;
    }
    .form-title {
        font-size: 22px;
        font-weight: bold;
        color: #2f80ed;
    }
    .form-control {
        border-radius: 5px;
        border: 1px solid #ccc;
        padding: 10px;
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
        padding: 8px 20px;
        border-radius: 5px;
        border: none;
    }
    .btn-cancel {
        background: #6c757d;
        color: white;
        padding: 8px 20px;
        border-radius: 5px;
        text-decoration: none;
    }
    .btn-kembali {
        background: #6c757d;
        color: white;
        font-weight: bold;
        padding: 7px 15px;
        border-radius: 5px;
        text-decoration: none;
    }
</style>
@endsection
