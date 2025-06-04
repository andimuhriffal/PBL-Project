<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class IotController extends Controller
{
    public function index()
    {
        return view('layouts.table');
    }

    public function getData()
    {
        try {
            $dhtResponse = Http::timeout(3)->get('http://api-gateway-service:7000/api/dht11/latest');
            $ultrasonikResponse = Http::timeout(3)->get('http://api-gateway-service:7000/api/ultrasonik/latest');
            $rtcResponse = Http::timeout(3)->get('http://api-gateway-service:7000/api/rtc-time');

            $dht = $dhtResponse->successful() ? $dhtResponse->json() : [];
            $ultrasonik = $ultrasonikResponse->successful() ? $ultrasonikResponse->json() : [];
            $rtc = $rtcResponse->successful() ? $rtcResponse->json() : [];

            return response()->json([
                // Data DHT
                'suhu'                     => $dht['suhu'] ?? null,
                'kelembapan'               => $dht['kelembapan'] ?? null,
                'lampu_status'             => $dht['lampuStatus'] ?? null,
                'kipas_status'             => $dht['kipasStatus'] ?? null,
                'status_sensor'            => $dht['statusSensor'] ?? 'Tidak diketahui',

                // Data Ultrasonik
                'tinggi_air'               => $ultrasonik['tinggiAir'] ?? null,
                'persentase_air'           => $ultrasonik['persentaseAir'] ?? null,
                'kran_terbuka'             => $ultrasonik['kranTerbuka'] ?? null,
                'status_sensor_ultrasonik' => $ultrasonik['statusSensor'] ?? 'Tidak diketahui',

                // Data RTC
                'waktu_pagi'               => $rtc['waktuPagi'] ?? null,
                'waktu_sore'               => $rtc['waktuSore'] ?? null,
                'status_pakan'             => $rtc['statusPakan'] ?? null,

                // Waktu dibuat
                'created_at'               => $ultrasonik['timestamp'] ?? now(),
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal mengambil data: ' . $e->getMessage()], 500);
        }
    }
}