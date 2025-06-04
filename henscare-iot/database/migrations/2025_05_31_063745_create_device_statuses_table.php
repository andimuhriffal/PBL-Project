<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Penting agar DB::table() bisa dipanggil

class CreateDeviceStatusesTable extends Migration
{
    public function up()
    {
        Schema::create('device_statuses', function (Blueprint $table) {
            $table->id();
            $table->enum('mode', ['manual', 'otomatis'])->default('otomatis');
            $table->boolean('lampu')->default(false);
            $table->boolean('kipas')->default(false);
            $table->boolean('kran')->default(false);
            $table->enum('motor_arah', ['kiri', 'kanan', 'maju', 'mundur', 'berhenti'])->nullable();
            $table->timestamps();
        });

        // Isi awal satu baris default
        DB::table('device_statuses')->insert([
            'lampu' => false,
            'kipas' => false,
            'kran'  => false,
            'motor_arah' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('device_statuses');
    }
}