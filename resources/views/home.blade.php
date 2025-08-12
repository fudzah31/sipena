<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DATA ARSIP BKD BANJARMASIN</title>

  <!-- Fonts & CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="{{ asset('sbadmin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
  <link href="{{ asset('sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">

  <style>
    body {
      background: radial-gradient(circle at top left, #f4f8ff 0%, #d9e8ff 40%, #ffffff 100%);
      background-attachment: fixed;
      color: #333;
      margin: 0;
      padding: 0;
    }

    .sidebar {
      width: 230px !important;
      background: linear-gradient(135deg, #0a2342, #1d4e89, #2a6fb0);
      background-size: 400% 400%;
      animation: waveMove 10s ease infinite, scaleFadeIn 0.8s ease-out forwards;
      box-shadow: inset 0 0 15px rgba(29, 78, 137, 0.3);
      overflow: hidden;
      position: fixed;
      height: 100vh;
      left: 0;
      top: 0;
      z-index: 1000;
    }

    #content-wrapper {
      margin-left: 230px;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    @keyframes waveMove {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    @keyframes scaleFadeIn {
      0% { opacity: 0; transform: scale(0.8); }
      100% { opacity: 1; transform: scale(1); }
    }

    .sidebar-brand {
      padding: 20px 10px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .sidebar-brand-icon img {
      height: 38px;
    }

    .sidebar-brand-text {
      font-family: 'Rubik', sans-serif;
      font-size: 20px;
      color: #ffffff;
      margin-left: 10px;
      font-weight: bold;
    }

    .nav-item a.nav-link {
      padding: 10px 15px;
      margin: 5px 15px;
      border-radius: 8px;
      color: #d0e6ff !important;
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.05);
      transition: all 0.3s ease;
    }

    .nav-item a.nav-link:hover {
      color: #ffffff !important;
      background: rgba(63, 135, 215, 0.2);
      box-shadow: 0 0 12px rgba(63, 135, 215, 0.4);
      transform: scale(1.03);
    }

    .nav-item.active a.nav-link {
      color: #ffffff !important;
      background: rgba(34, 193, 195, 0.2);
      border: 1px solid rgba(34, 193, 195, 0.5);
    }

    .topbar {
      background: rgba(255,255,255,0.8) !important;
      backdrop-filter: blur(6px);
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 20px;
    }

    .header-title {
      font-size: 15px;
      font-weight: 600;
      font-family: 'Nunito', sans-serif;
      color: #1d4e89;
      display: flex;
      align-items: center;
    }

    .header-title img {
      height: 32px;
      margin-right: 10px;
    }

    .card-custom {
      transition: all 0.3s ease-in-out;
      border-radius: 15px;
      min-height: 130px;
      background: rgba(255,255,255,0.9);
      backdrop-filter: blur(6px);
      border: 1px solid rgba(29, 78, 137, 0.1);
      animation: scaleFadeIn 0.7s ease forwards;
    }

    .card-custom:hover {
      transform: scale(1.01);
      box-shadow: 0 4px 20px rgba(29, 78, 137, 0.3);
    }

    .gradient-warning { border-left: 6px solid #1d4e89; }
    .gradient-primary { border-left: 6px solid #3f87d7; }
    .gradient-success { border-left: 6px solid #2a6fb0; }
    .gradient-info    { border-left: 6px solid #5fa8f5; }

    .count-number {
      font-size: 28px;
      font-weight: bold;
      color: #1d4e89;
    }

    .sticky-footer {
      background: #0a2342;
      color: #d0e6ff;
      padding: 5px 0;
      font-size: 13px;
      margin-top: auto;
    }

    .judul-utama {
      font-family: 'Nunito', sans-serif;
      font-weight: 800;
      font-size: 28px;
      color: #1d4e89;
      text-align: center;
    }

    .subjudul {
      font-family: 'Nunito', sans-serif;
      font-size: 16px;
      color: #555;
      text-align: center;
      margin-bottom: 25px;
    }
  </style>
</head>
<body id="page-top">

<audio id="hoverSound" src="https://cdn.pixabay.com/download/audio/2021/08/04/audio_16d922bf28.mp3?filename=click-124467.mp3"></audio>

<div id="wrapper">
  <!-- Sidebar -->
  <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand" href="/">
      <div class="sidebar-brand-icon"><img src="{{ asset('image/logosipena.png') }}"></div>
      <div class="sidebar-brand-text">SIPENA</div>
    </a>

    <hr class="sidebar-divider my-0">
    <li class="nav-item active"><a class="nav-link" href="/"><i class="fa-solid fa-gauge fa-fw"></i> Dashboard</a></li>

   <hr class="sidebar-divider">
<div class="sidebar-heading">Input Data</div>

<li class="nav-item">
  <a class="nav-link" href="{{ route('surat-masuk.index') }}">
    <i class="fa-solid fa-cog fa-fw"></i> Surat Masuk
  </a>
</li>

<li class="nav-item">
  <a class="nav-link" href="{{ route('surat-keluar.index') }}">
    <i class="fa-solid fa-paper-plane fa-fw"></i> Surat Keluar
  </a>
</li>

<li class="nav-item">
  <a class="nav-link" href="{{ route('nota-dinas.index') }}">
    <i class="fa-solid fa-file-lines fa-fw"></i> Nota Dinas
  </a>
</li>


    <hr class="sidebar-divider">
    <div class="sidebar-heading">Daftar Arsip Data</div>
    <li class="nav-item {{ request()->is('arsip/surat-masuk*') ? 'active' : '' }}">
  <a class="nav-link" href="{{ route('arsip.surat-masuk.form') }}">
    <i class="fa-solid fa-folder-open fa-fw"></i> Daftar Surat Masuk
  </a>
</li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('arsip.surat-keluar.form') }}">
        <i class="fa-solid fa-arrow-up-right-dots fa-fw"></i> Daftar Surat Keluar
    </a>
</li>

   <li class="nav-item">
    <a class="nav-link" href="{{ route('arsip.nota-dinas.form') }}">
        <i class="fa-solid fa-table-list fa-fw"></i> Daftar Nota Dinas
    </a>
</li>

  </ul>

  <!-- Content -->
  <div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
      <!-- Topbar -->
      <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow">
        <div class="header-title">
          <img src="{{ asset('image/logobjmsn.png') }}">
          BADAN KEPEGAWAIAN DAERAH, PENDIDIKAN DAN PELATIHAN KOTA BANJARMASIN
        </div>
      
      </nav>

      <!-- Judul -->
      <div class="container-fluid">
        <h1 class="judul-utama">SISTEM INFORMASI PENGELOLAAN NASKAH ADMINISTRATIF</h1>
      </div>

      <!-- Statistik -->
      <div class="container-fluid mt-3">
        <div class="row mb-4">
          <div class="col-12">
            <div class="card card-custom gradient-warning shadow">
              <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size:18px;">Total Semua Surat</div>
                  <div class="count-number" data-count="{{ $totalSemua }}">0</div>
                </div>
                <i class="fa-solid fa-envelope fa-3x text-primary"></i>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4">
            <div class="card card-custom gradient-primary shadow">
              <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Surat Masuk</div>
                  <div class="count-number">{{ $totalSuratMasuk }}</div>
                </div>
                <i class="fa-solid fa-download fa-2x text-primary"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card card-custom gradient-success shadow">
              <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Surat Keluar</div>
                  <div class="count-number">{{ $totalSuratKeluar }}</div>
                </div>
                <i class="fa-solid fa-upload fa-2x text-success"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card card-custom gradient-info shadow">
              <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Nota Dinas</div>
                  <div class="count-number">{{ $totalNotaDinas }}</div>
                </div>
                <i class="fa-solid fa-file-alt fa-2x text-info"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer class="sticky-footer mt-auto">
      <div class="container my-auto">
        <div class="text-center my-auto">
          <span>&copy; 2025 Pemerintah Kota Banjarmasin. <br>Dikembangkan oleh BKD - Diklat Kota Banjarmasin.</span>
        </div>
      </div>
    </footer>
  </div>
</div>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>AOS.init({ duration:1200, once:true });</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll('.count-number[data-count]').forEach(counter => {
    let target = +counter.getAttribute('data-count'), count = 0, step = Math.ceil(target / 50);
    const update = () => {
      count += step;
      if (count < target) {
        counter.innerText = count;
        setTimeout(update, 50);
      } else {
        counter.innerText = target;
      }
    };
    update();
  });

  document.querySelectorAll('.nav-item a.nav-link').forEach(link => {
    link.addEventListener('mouseenter', () => document.getElementById('hoverSound').play());
  });
});
</script>

<script src="{{ asset('sbadmin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('sbadmin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('sbadmin/js/sb-admin-2.min.js') }}"></script>

</body>
</html>
