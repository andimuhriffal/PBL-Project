<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeviceStatus;
use Illuminate\Support\Facades\DB;

class DeviceController extends Controller
{
    /**
     * Update status perangkat (hanya jika mode manual).
     */
    public function updateStatus(Request $request)
    {
        $request->validate([
            'device' => 'required|in:lampu,kipas,kran,motor',
            'status' => 'required|boolean',
        ]);

        $device = $request->device;
        $status = $request->status;

        $data = DeviceStatus::firstOrCreate([], [
            'mode' => 'otomatis',
            'lampu' => false,
            'kipas' => false,
            'kran' => false,
            'motor' => false,
        ]);

        if ($data->mode !== 'manual') {
            return response()->json([
                'message' => "Gagal: Perangkat dalam mode otomatis. Tidak dapat diubah secara manual.",
                'status' => $data
            ], 403);
        }

        $data->update([$device => $status]);

        return response()->json([
            'message' => "$device berhasil diatur ke " . ($status ? 'ON' : 'OFF') . " (manual)",
            'status' => $data
        ]);
    }

    /**
     * Endpoint polling untuk mikrokontroler.
     */
    public function getStatus()
    {
        $data = DeviceStatus::firstOrCreate([], [
            'mode' => 'otomatis',
            'lampu' => false,
            'kipas' => false,
            'kran' => false,
            'motor' => false
        ]);

        return response()->json($data);
    }

    /**
     * Ubah mode manual atau otomatis.
     */
    public function setMode(Request $request)
    {
        $request->validate([
            'mode' => 'required|in:manual,otomatis'
        ]);

        $data = DeviceStatus::firstOrCreate([], [
            'mode' => 'otomatis',
            'lampu' => false,
            'kipas' => false,
            'kran' => false,
            'motor' => false,
        ]);

        $data->update(['mode' => $request->mode]);

        return response()->json([
            'message' => "Mode berhasil diatur ke {$request->mode}",
            'status' => $data
        ]);
    }

    /**
     * Gerakkan motor ke arah tertentu (hanya dalam mode manual).
     */
    public function gerakMotor($arah)
    {
        $arahValid = ['kiri', 'kanan', 'maju', 'mundur', 'berhenti'];
            if (!in_array($arah, $arahValid)) {
        return response()->json(['error' => 'Arah motor tidak valid'], 400);
    }
        $data = DeviceStatus::first();
            if (!$data || $data->mode !== 'manual') {
            return response()->json([
                'message' => "Gagal: Gerak motor hanya bisa dilakukan dalam mode manual."
            ], 403);
    }
        $data->update(['motor_arah' => $arah]);

            return response()->json([
                'message' => "Motor bergerak ke arah: $arah"
            ]);
    }

    public function getArahMotor()
    {
        $record = DB::table('motor_arah')->where('id', 1)->first();
            if (!$record) {
            return response()->json(['arah' => 'berhenti']);
    }
            return response()->json(['arah' => $record->arah]);
    }
    public function getMode()
    {
        $data = DB::table('device_statuses')->first();
            if (!$data) {
            return response()->json(['error' => 'Data not found'], 404);
        }
        return response()->json(['mode' => $data->mode]);
    }


    /**
     * Endpoint alternatif toggle via URL (optional).
     * Contoh: /api/device/kipas/on
     */
    public function toggle($device, $status)
    {
        $allowedDevices = ['lampu', 'kipas', 'kran', 'motor'];
        if (!in_array($device, $allowedDevices)) {
            return response()->json(['error' => 'Device tidak valid'], 400);
        }

        $state = $status === 'on';

        $data = DeviceStatus::firstOrCreate([], [
            'mode' => 'otomatis',
            'lampu' => false,
            'kipas' => false,
            'kran' => false,
            'motor' => false,
        ]);

        if ($data->mode !== 'manual') {
            return response()->json([
                'message' => "Perangkat dalam mode otomatis. Gunakan mode manual untuk toggle.",
                'status' => $data
            ], 403);
        }

        $data->update([$device => $state]);

        return response()->json([
            'message' => "$device berhasil diatur ke " . ($state ? 'OTOMATIS' : 'MENUAL'),
            'status' => $data
        ]);
    }
}