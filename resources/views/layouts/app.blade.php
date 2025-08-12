<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIPENA - Sistem Pengelolaan Surat')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8fafc;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            font-size: 1.4rem;
            font-weight: bold;
        }
        .navbar-brand img {
            height: 36px;
            width: auto;
            margin-right: 10px;
        }
        .footer {
            font-size: 14px;
            text-align: center;
            color: #888;
            padding: 15px 0;
            border-top: 1px solid #eaeaea;
            margin-top: 50px;
        }
    </style>

    @stack('styles')
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('image/logosipena.png') }}" alt="Logo SIPENA">
                <span>SIPENA</span>
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        @yield('content')
    </div>

    <!-- Footer -->
    <div class="footer">
        &copy; {{ date('Y') }} BKD Kota Banjarmasin. Dikembangkan oleh Tim SIPENA.
    </div>

    <!-- JS Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- ✅ Tambahkan SweetAlert agar otomatis jalan --}}
    @include('sweetalert::alert')

    @stack('scripts')
</body>
</html>
