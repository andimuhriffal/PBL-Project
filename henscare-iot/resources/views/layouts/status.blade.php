@extends('layouts.app')

@section('title', 'Dashboard IoT')

@section('content')

<div class="py-3 text-center mt-0">
    <div class="container text-white" style="max-width: 700px;">
        <div class="d-flex align-items-center justify-content-center">
            <img src="images/STATUS AYAM.png" alt="Hens Care" style="width: 140px; height: 140px; margin-right: 10px;">
            <h4 class="mb-3">
                Cek Status Kipas, Lampu, Dan Kran Air Pakan
            </h4>
        </div>
    </div>
</div>

<!-- ROW 2 - Gambar perangkat -->
<div class="row g-4 justify-content-center">
    <!-- LAMPU -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="dashboard-box">
            <i class="bi bi-lightbulb-fill text-warning dashboard-icon"></i>
            <div class="title">Lampu</div>
            <div class="d-flex justify-content-center align-items-center" style="height: 150px;">
                <img id="lampu-gambar" src="/images/light_off.png" alt="Lampu" class="device-image">
            </div>
            <div id="lampu-status" class="value">OFF</div>
        </div>
    </div>

    <!-- KIPAS -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="dashboard-box">
            <i class="bi bi-wind dashboard-icon text-secondary"></i>
            <div class="title">Kipas</div>
            <div class="d-flex justify-content-center align-items-center" style="height: 150px;">
                <img id="fan-gambar" src="/images/fan_off.png" alt="Kipas" class="device-image">
            </div>
            <div id="fan-status" class="value">OFF</div>
        </div>
    </div>

    <!-- KRAN -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="dashboard-box">
            <i class="bi bi-water dashboard-icon text-primary"></i>
            <div class="title">Kran Air Minum</div>
            <div class="d-flex justify-content-center align-items-center" style="height: 150px;">
                <img id="kran-gambar" src="/images/water_off.png" alt="Kran" class="device-image">
            </div>
            <div id="kran-status" class="value">TERTUTUP</div>
        </div>
    </div>

    <!-- WADAH PAKAN  -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="dashboard-box">
            <i class="bi bi-basket-fill dashboard-icon text-primary"></i>
            <div class="title">Wadah Pakan</div>
            <div class="d-flex justify-content-center align-items-center" style="height: 150px;">
                <img id="kran-gambar" src="/images/wadah-terisi.png" alt="Kran" class="device-image">
            </div>
            <div id="kran-status" class="value">TERTUTUP</div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="/js/status-kandang.js"></script>
@endsection