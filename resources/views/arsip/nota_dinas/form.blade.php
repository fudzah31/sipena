@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary fw-bold">📑 Arsip Nota Dinas</h2>
        <a href="{{ url('/') }}" class="btn btn-back">🏠 Beranda</a>
    </div>

    <div class="card shadow-sm rounded">
        <div class="card-body">
            <form action="{{ route('arsip.nota-dinas.preview') }}" method="GET"
                  class="row gy-3 gx-3 align-items-end">
                <div class="col-md-6">
                    <label for="progress" class="form-label fw-semibold">Status Progress</label>
                    <select id="progress" name="progress" class="form-select">
                        <option value="" {{ old('progress')=='' ? 'selected' : '' }}>
                            -- Semua Status --
                        </option>
                        @foreach([
                            'DIKIRIM',
                            'DALAM PERJALANAN',
                            'DITERIMA INSTANSI TUJUAN',
                            'SELESAI',
                            'DIBATALKAN',
                        ] as $status)
                            <option value="{{ $status }}"
                                {{ old('progress') == $status ? 'selected' : '' }}>
                                {{ ucwords(strtolower($status)) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 text-end">
                    <button type="submit" class="btn btn-add px-4">
                        🔍 Preview
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.btn-add {
    background: #2f80ed;
    color: white;
    padding: 7px 20px;
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
</style>
@endsection
