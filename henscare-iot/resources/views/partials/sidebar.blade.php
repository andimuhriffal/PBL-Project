<div class="sidebar d-flex flex-column flex-shrink-0 p-3 shadow-lg position-fixed vh-100"
    style="width: 250px; background: linear-gradient(to bottom, rgb(161, 161, 143),rgb(161, 161, 143)); border-right: 1px solid rgb(161, 161, 143);">

    <!-- Logo dan Judul -->
    <div class="d-flex align-items-center mb-4 text-decoration-none">
        <img src="{{ asset('images/hens.png') }}" alt="Hens Care" width="150" class="me-2 rounded-circle">
    </div>

    <hr class="my-2">

    <!-- Menu Navigasi -->
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item mb-1">
            <a href="/dashboard"
                class="nav-link d-flex align-items-center rounded {{ request()->is('dashboard') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="fas fa-chart-line me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ route('tabel.pakan') }}"
                class="nav-link d-flex align-items-center rounded {{ request()->is('tabel-pakan') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="fas fa-table me-2"></i> Tabel Riwayat
            </a>
        </li>

        <li class="nav-item mb-1">
            <a href="/sensor-health"
                class="nav-link d-flex align-items-center rounded {{ request()->is('sensor-health') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="fas fa-heartbeat me-2"></i> Status Sensor
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="/status-kandang"
                class="nav-link d-flex align-items-center rounded {{ request()->is('status-kandang') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="fas fa-lightbulb me-2"></i> Kondisi Otomatisasi
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="/kontrol-modul"
                class="nav-link d-flex align-items-center rounded {{ request()->is('kontrol-modul') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="fas fa-hand-point-right me-2"></i> Kontrol Alat
            </a>
        </li>

    </ul>

    <hr class="my-3">

    <!-- Tombol Logout -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn w-100 d-flex align-items-center justify-content-center rounded">
            <i class="fas fa-sign-out-alt me-2"></i> Logout
        </button>
    </form>
</div>