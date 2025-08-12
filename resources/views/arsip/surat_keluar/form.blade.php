@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary fw-bold">📤 Arsip Surat Keluar</h2>
        <a href="{{ url('/') }}" class="btn btn-back">🏠 Beranda</a>
    </div>

    <div class="card shadow-sm rounded">
        <div class="card-body">
            <form action="{{ route('arsip.surat-keluar.preview') }}" method="GET" class="row gy-3 gx-3 align-items-end">
                <div class="col-md-4">
                    <label for="bulan" class="form-label fw-semibold">Bulan</label>
                    <select id="bulan" name="bulan" class="form-select">
                        @foreach(range(1,12) as $m)
                            <option value="{{ $m }}">{{ DateTime::createFromFormat('!m', $m)->format('F') }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="tahun" class="form-label fw-semibold">Tahun</label>
                    <input type="number" id="tahun" name="tahun" class="form-control"
                           value="{{ date('Y') }}" min="2000" max="{{ date('Y') + 1 }}" required>
                </div>
                <div class="col-md-4 text-end">
                    <button type="submit" class="btn btn-add px-4">🔍 Preview</button>
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
