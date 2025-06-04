@extends('layouts.app')

@section('title', 'Dashboard IoT')

@section('content')

<div class="py-3 text-center mt-0">
    <div class="container text-white" style="max-width: 700px;">
        <div class="d-flex align-items-center justify-content-center">
            <img src="images/STATUS AYAM.png" alt="Hens Care" style="width: 140x; height: 120px; margin-right: 10px;">
            <h4 class="mb-3">
                Halaman Status Modul Dan Sensor
            </h4>
        </div>
    </div>
</div>
<div class="container py-4">
    <div class="row g-4 justify-content-center">
        <!-- Sensor DHT11 -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="dashboard-box text-center p-3 shadow rounded bg-light">
                <div class="title fw-bold mb-2">Status Sensor DHT11</div>
                <div class="mb-2">
                    <i id="dht-status-icon" class="bi bi-heart-pulse-fill fs-2 text-success"></i>
                </div>
                <img id="dht-status-img" src="{{ asset('images/sensors/dht-off.png') }}" alt="DHT11" class="mb-3"
                    width="150">
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="dashboard-box text-center p-3 shadow rounded bg-light">
                <div class="title fw-bold mb-2">Status Sensor Ultrasonik</div>
                <div class="mb-2">
                    <i id="ultrasonik-status-icon" class="bi bi-wifi fs-2 text-success"></i>
                </div>
                <img id="ultrasonik-status-img" src="{{ asset('images/sensors/ultrasonik-on.png') }}" alt="ultrasonik"
                    class="mb-3" width="200">
                <div class="static-chart-container">
                    <div id="ultrasonik-chart" class="static-chart"></div>
                </div>
            </div>
        </div>


        <div class="col-12 col-sm-6 col-lg-3">
            <div class="dashboard-box text-center p-3 shadow rounded bg-light">
                <div class="title fw-bold mb-2">Status Modul RTC</div>
                <div class="mb-2">
                    <i class="bi bi-heart-pulse-fill fs-2 text-success"></i>
                </div>
                <img src="{{ asset('images/sensors/rtc-off.png') }}" alt="rtc" class="mb-3" width="200">
                <div class="static-chart-container">
                    <div id="rtc-chart" class="static-chart"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="/js/dht-status.js"></script>
<script src="/js/ultrasonik-status.js"></script>
@endsection