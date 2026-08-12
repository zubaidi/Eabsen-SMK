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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade'); // FK ke kelas[cite: 7]
            $table->string('nis')->unique(); // varchar, unique[cite: 7]
            $table->string('nisn')->nullable(); // varchar, nullable[cite: 7]
            $table->string('nama'); // varchar[cite: 7]
            $table->enum('jenis_kelamin', ['L', 'P']); // enum[cite: 7]
            $table->string('foto')->nullable(); // varchar, nullable[cite: 7]
            $table->enum('status', ['aktif', 'lulus', 'pindah', 'keluar'])->default('aktif'); // enum[cite: 7]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
