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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jurusan_id')->constrained('jurusans')->onDelete('cascade'); // FK ke jurusans[cite: 7]
            $table->enum('tingkat', ['X', 'XI', 'XII']); // enum[cite: 7]
            $table->string('nama_kelas'); // Contoh: X RPL 1[cite: 7]
            $table->foreignId('wali_kelas_id')->nullable()->constrained('users')->nullOnDelete(); // FK ke users, nullable[cite: 7]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
