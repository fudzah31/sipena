<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Arsip Surat Masuk</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 11px;
      margin: 30px;
      color: #222;
    }

    h3 {
      text-align: center;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      table-layout: fixed;
      word-wrap: break-word;
    }

    th, td {
      border: 1px solid #000;
      padding: 6px;
      vertical-align: top;
    }

    th {
      background-color: #f0f0f0;
      text-align: center;
    }

    .text-center {
      text-align: center;
    }

    .text-muted {
      color: #777;
    }
  </style>
</head>
<body>
  <h3>Arsip Surat Masuk: {{ \DateTime::createFromFormat('!m', $r->bulan)->format('F') }} {{ $r->tahun }}</h3>

  <table>
    <thead>
      <tr>
        <th>Nomor</th>
        <th>No Surat</th>
        <th>Asal Surat</th>
        <th>Kategori</th>
        <th>Perihal</th>
        <th>Isi Surat</th>
        <th>File</th>
        <th>Bidang</th>
        <th>Keterangan Penerima</th>
        <th>Tanggal Surat</th>
        <th>Tanggal Masuk</th>
      </tr>
    </thead>
    <tbody>
      @forelse($items as $it)
        <tr>
          <td class="text-center">{{ $it->nomor }}</td>
          <td>{{ $it->no_surat }}</td>
          <td>{{ $it->asal_surat }}</td>
          <td>{{ $it->kategori }}</td>
          <td>{{ $it->perihal }}</td>
          <td>{!! nl2br(e($it->isi_surat)) !!}</td>
          <td class="text-center">{{ $it->file_path ? 'Ada File' : '-' }}</td>
          <td>{{ $it->bidang }}</td>
          <td>{{ $it->keterangan_penerima }}</td>
          <td class="text-center">{{ \Carbon\Carbon::parse($it->tanggal_surat)->format('d/m/Y') }}</td>
          <td class="text-center">{{ \Carbon\Carbon::parse($it->tanggal_masuk)->format('d/m/Y') }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="11" class="text-center text-muted">Tidak ada data surat masuk pada bulan ini.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</body>
</html>
