@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">Kontrol Menual </h2>
    <div class="row">
        <div class="mb-4 text-center">
            <label for="modeSelect" class="form-label fw-bold">Pilih Mode:</label>
            <select onchange="ubahMode(this.value)" class="form-select mb-4">
                <option value="manual">Manual</option>
                <option value="otomatis">Otomatis</option>
            </select>
        </div>
        {{-- Lampu --}}
        <div class="col-md-3 mb-4">
            <div class="card text-center shadow border-0">
                <div class="card-header bg-warning text-white">
                    <i class="fas fa-lightbulb me-2"></i>Lampu
                </div>
                <div class="card-body">
                    <img id="lampu-gambar" src="/images/light_off.png" alt="Lampu" class="img-fluid mb-2"
                        style="width: 100px; cursor: pointer;" onclick="toggleDevice('lampu')">
                    <div id="lampu-status" class="fw-bold text-muted">OFF</div>
                </div>
            </div>
        </div>

        {{-- Kipas --}}
        <div class="col-md-3 mb-4">
            <div class="card text-center shadow border-0">
                <div class="card-header bg-black text-white">
                    <i class="fas fa-fan me-2"></i>Kipas
                </div>
                <div class="card-body">
                    <img id="fan-gambar" src="/images/fan_off.png" alt="Kipas" class="img-fluid mb-2"
                        style="width: 100px; cursor: pointer;" onclick="toggleDevice('kipas')">
                    <div id="fan-status" class="fw-bold text-muted">OFF</div>
                </div>
            </div>
        </div>

        {{-- Kran Air --}}
        <div class="col-md-3 mb-4">
            <div class="card text-center shadow border-0">
                <div class="card-header bg-info text-white">
                    <i class="fas fa-tint me-2"></i>Kran Air
                </div>
                <div class="card-body">
                    <img id="kran-gambar" src="/images/water_off.png" alt="Kran" class="img-fluid mb-2"
                        style="width: 100px; cursor: pointer;" onclick="toggleDevice('kran')">
                    <div id="kran-status" class="fw-bold text-muted">TERTUTUP</div>
                </div>
            </div>
        </div>

        {{-- Motor DC --}}
        <div class="col-md-3 mb-4">
            <div class="card text-center shadow border-0">
                <div class="card-header bg-success text-white">
                    <i class="fas fa-cogs me-2"></i>Motor DC 12V
                </div>
                <div class="card-body d-flex flex-column align-items-center gap-3">
                    <img id="motor-gambar" src="/images/motor.png" alt="Motor" class="img-fluid mb-2"
                        style="width: 100px;">
                    <div class="d-flex justify-content-center w-100 px-3 gap-3">
                        <button onclick="gerakMotor('mundur')"
                            class="btn btn-outline-primary rounded-pill shadow-sm px-4 d-flex align-items-center gap-2">
                            <i class="fas fa-arrow-left"></i>
                        </button>

                        <button onclick="gerakMotor('berhenti')"
                            class="btn btn-outline-danger rounded-pill shadow-sm px-4 d-flex align-items-center justify-content-center"
                            style="width: 48px; padding: 0;">
                            <i class="fas fa-stop-circle fs-4"></i>
                        </button>

                        <button onclick="gerakMotor('maju')"
                            class="btn btn-outline-primary rounded-pill shadow-sm px-4 d-flex align-items-center gap-2">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@section('scripts')
<script src="/js/kontrol.js"></script>
@endsection