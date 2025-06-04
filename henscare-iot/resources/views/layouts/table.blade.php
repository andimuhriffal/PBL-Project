@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center fw-bold">
        📊 Table Riwayat
    </h2>

    <div class="table-responsive">
        <table class="table table-hover table-bordered shadow rounded text-center align-middle table-custom">
            <thead class="table-dark">
                <tr>
                    <th>🌡️ Suhu</th>
                    <th>Status</th>
                    <th>💧 Air Minum</th>
                    <th>Status</th>
                    <th>🌫️ Kelembapan</th>
                    <th>Status</th>
                    <th>🌞 Pakan Pagi</th>
                    <th>🌅 Pakan Sore</th>
                    <th>Status</th>
                    <th>🕒 Waktu</th>
                </tr>
            </thead>
            <tbody id="realtime-table">
                {{-- Data akan diisi oleh table.js --}}
            </tbody>
        </table>
    </div>

</div>
@endsection

@section('scripts')
<script src="/js/table.js"></script>

@endsection