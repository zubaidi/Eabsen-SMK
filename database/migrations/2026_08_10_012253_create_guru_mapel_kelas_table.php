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
        Schema::create('guru_mapel_kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guru_id')->constrained('users')->onDelete('cascade'); // FK ke users.id
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade'); // FK ke kelas.id
            $table->foreignId('mapel_id')->constrained('mata_pelajarans')->onDelete('cascade'); // FK ke mata_pelajarans.id
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guru_mapel_kelas');
    }
};
