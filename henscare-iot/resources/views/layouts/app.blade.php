<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sidebarmode.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mobile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
    <script src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
    <script src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>
    @include('partials.sidebar')

    <main>
        @yield('content')
        <div class="bottom-nav d-md-none">
            <a href="{{ route('tabel.pakan') }}" class="{{ request()->is('tabel/pakan') ? 'active' : '' }}">
                <div class="nav-item">
                    <i class="fas fa-table"></i>
                </div>
            </a>
            <a href="/sensor-health" class="{{ request()->is('sensor-health') ? 'active' : '' }}">
                <div class="nav-item">
                    <i class="fas fa-heartbeat"></i>
                </div>
            </a>
            <a href="/dashboard" class="{{ request()->is('dashboard*') ? 'active' : '' }}">
                <div class="nav-item center-btn">
                    <i class="fas fa-chart-line"></i>
                </div>
            </a>
            <a href="/status-kandang" class="{{ request()->is('status-kandang*') ? 'active' : '' }}">
                <div class="nav-item center-btn">
                    <i class="fas fa-lightbulb"></i>
                </div>
            </a>
            <a href="/kontrol-modul" class="{{ request()->is('kontrol-modul') ? 'active' : '' }}">
                <div class="nav-item">
                    <i class="fas fa-cogs"></i>
                </div>
            </a>
        </div>
        </div>
    </main>


    @yield('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>