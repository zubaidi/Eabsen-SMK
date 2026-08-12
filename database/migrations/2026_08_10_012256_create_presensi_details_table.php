<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('presensi_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('presensi_id')->constrained('presensis')->onDelete('cascade'); // FK ke presensis.id[cite: 8]
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade'); // FK ke siswas.id[cite: 8]
            $table->enum('status', ['hadir', 'izin', 'sakit', 'alpa', 'terlambat']); // enum status[cite: 8]
            $table->string('keterangan')->nullable(); // varchar, nullable[cite: 8]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi_details');
    }
};
