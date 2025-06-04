@extends('layouts.app')

@section('title', 'Dashboard IoT')

@section('content')
<div class="py-3 text-center mt-0">
    <div class="container text-white" style="max-width: 700px;">
        <div class="d-flex align-items-center justify-content-center">
            <img src="images/dashboard.png" alt="Hens Care" style="width: 120px; height: 140px; margin-right: 10px;">
            <h4 class="mb-3">
                Selamat datang di Dashboard Hens Care
                <!-- - Sistem Monitoring Paka Cerdas Berbasis IoT -->
            </h4>
        </div>
    </div>
</div>

<div class="container py-4">
    <!-- ROW 1 - 4 chart -->
    <div class="row g-4 justify-content-center">

        <!-- SUHU -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="dashboard-box">
                <i class="bi bi-thermometer-half text-danger dashboard-icon"></i>
                <div class="title">Suhu Kandang</div>
                <div id="suhu-value" class="value">-- °C</div>
                <div id="chart-temp" style="width: 100%; height: 240px;"></div>
            </div>
        </div>

        <!-- KELEMBAPAN -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="dashboard-box">
                <i class="bi bi-droplet-fill text-primary dashboard-icon"></i>
                <div class="title">Kelembapan Kandang</div>
                <div id="kelembapan-value" class="value">-- %</div>
                <div id="chart-humidity" style="width: 100%; height: 240px;"></div>
            </div>
        </div>

        <!-- AIR MINUM -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="dashboard-box">
                <i class="bi bi-cup-straw text-success dashboard-icon"></i>
                <div class="title">Informasi Air Minum</div>
                <div class="value"></div>
                <div id="chart-tinggi-air" style="width: 100%; height: 275px;"></div>
            </div>
        </div>

        <!-- JAM OPERASIONAL -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="dashboard-box">
                <i class="bi bi-clock-history text-info dashboard-icon"></i>
                <div class="title">Waktu Pemberian Pakan</div>
                <div class="value jam-digital" id="jam-operasional-text" style="display: none;">--:--:--</div>
                <div class="mt-2" id="form-waktu-pakan">
                    <div class="row g-1">
                        <div class="col-6">
                            <input type="time" id="waktu-pagi" class="form-control" required>
                            <small class="text-muted">Pagi</small>
                        </div>
                        <div class="col-6">
                            <input type="time" id="waktu-sore" class="form-control" required>
                            <small class="text-muted">Sore</small>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center mt-3">
                    <img id="ayam-gambar" src="images/ayam-2.png" alt="Ayam" class="device-image">
                </div>
                <button id="btn-set-pakan" class="btn btn-sm btn-primary mt-3 w-100">Simpan</button>
                <button id="btn-batal" class="btn btn-sm btn-danger mt-3 w-100" style="display: none;">Batalkan
                    Setelan</button>
                <div id="chart-jam"></div>
            </div>
        </div>
    </div>

    @endsection
    @section('scripts')
    <script src="/js/chart.js"></script>
    <script src="/js/rtc.js"></script>
    @endsection