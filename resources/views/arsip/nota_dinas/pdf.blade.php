<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Arsip Nota Dinas</title>
  <style>
    body { font-family: sans-serif; }
    table { width:100%; border-collapse:collapse; font-size:12px; }
    th, td { border:1px solid #444; padding:4px; text-align:center; }
    thead { background:#333; color:#fff; }
  </style>
</head>
<body>
  <h4>
    Arsip Nota Dinas
    @if(request('progress'))
      ({{ request('progress') }})
    @endif
  </h4>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nomor Nota</th>
        <th>SKPD</th>
        <th>Penerima</th>
        <th>Perihal</th>
        <th>Progress</th>
        <th>Tanggal Buat</th>
      </tr>
    </thead>
    <tbody>
      @forelse($items as $it)
        <tr>
          <td>{{ $it->nomor }}</td>
          <td>{{ $it->nomor_nota }}</td>
          <td>{{ $it->skpd->nama ?? '-' }}</td>
          <td>{{ $it->penerima }}</td>
          <td>{{ $it->perihal }}</td>
          <td>{{ $it->progress }}</td>
          <td>{{ \Carbon\Carbon::parse($it->created_at)->format('d-m-Y') }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="7" class="text-center text-muted">Tidak ada Nota Dinas.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</body>
</html>
