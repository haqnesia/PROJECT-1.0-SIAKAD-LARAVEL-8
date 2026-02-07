<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>USP | Siakad</title>

    <!-- Bootstrap 4.5.2 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

        @section('css')
        @show

    <style>

        body {
            background-color: #f4f6f9;
        }

        .navbar {
            box-shadow: 0 2px 8px rgba(0,0,0,.08);
        }

        .navbar .nav-link {
            color: #495057;
            font-weight: 500;
            position: relative;
        }

        .navbar .nav-link.active {
            color: #0d6efd;
        }

        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,.08);
        }

        table th {
            background-color: #f8f9fa;
            text-align: center;
        }

        table td {
            vertical-align: middle;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
        @include('layouts.header')
    </nav>

    <!-- CONTENT -->
    <div class="container" style="margin-top: 90px;">
        @yield('content')
    </div>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    @section('js')
    @show
</body>
</html>
