<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IotDataController;
use App\Http\Controllers\Api\IotController;
use App\Models\IotData;
use App\Http\Controllers\DeviceController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/iot', [IotDataController::class, 'store']);
Route::get('/get-iot', [IotController::class, 'getData']);
Route::get('/device/status', [DeviceController::class, 'getStatus']);
Route::post('/device/update', [DeviceController::class, 'updateStatus']);
Route::post('/device/mode', [DeviceController::class, 'setMode']);
Route::post('/motor/gerak/{arah}', [DeviceController::class, 'gerakMotor']);
Route::get('/device/{device}/{status}', [DeviceController::class, 'toggle']);
Route::get('/device/motor/{arah}', [DeviceController::class, 'getArahMotor']);
Route::get('/mode', [DeviceController::class, 'getMode']);