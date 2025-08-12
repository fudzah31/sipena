<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Arsip Surat Keluar</title>
  <style>
    body {
      font-family: sans-serif;
      margin: 20px;
    }
    h4 {
      margin-bottom: 10px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 12px;
    }
    th, td {
      border: 1px solid #444;
      padding: 8px;
      text-align: center;
      vertical-align: middle;
    }
    th {
      background: #2f80ed;
      color: #fff;
    }
    tbody tr:nth-child(even) {
      background: #f9f9f9;
    }
  </style>
</head>
<body>
  <h4>Arsip Surat Keluar</h4>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>No Surat</th>
        <th>Bidang</th>
        <th>Kategori</th>
        <th>SKPD</th>
        <th>Perihal</th>
        <th>Tgl Surat</th>
        <th>Tgl Kirim</th>
      </tr>
    </thead>
    <tbody>
      @forelse($items as $it)
        <tr>
          <td>{{ $it->nomor }}</td>
          <td>{{ $it->no_surat }}</td>
          <td>{{ $it->bidang }}</td>
          <td>{{ $it->kategori }}</td>
          <td>{{ $it->skpd->nama ?? '-' }}</td>
          <td>{{ $it->perihal }}</td>
          <td>{{ \Carbon\Carbon::parse($it->tanggal_surat)->format('d-m-Y') }}</td>
          <td>{{ \Carbon\Carbon::parse($it->tanggal_pengantaran)->format('d-m-Y') }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="8" class="text-center text-muted">Tidak ada data.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</body>
</html>
