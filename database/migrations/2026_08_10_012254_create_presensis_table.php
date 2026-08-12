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
        Schema::create('presensis', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal'); // date
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade'); // FK ke kelas.id
            $table->enum('jenis', ['mapel', 'bk']); // enum: mapel, bk
            $table->foreignId('mapel_id')->nullable()->constrained('mata_pelajarans')->onDelete('set null'); // FK ke mata_pelajarans.id, nullable
            $table->foreignId('dicatat_oleh')->constrained('users')->onDelete('cascade'); // FK ke users.id (guru/BK yang input)
            $table->string('keterangan')->nullable(); // varchar, nullable
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensis');
    }
};
