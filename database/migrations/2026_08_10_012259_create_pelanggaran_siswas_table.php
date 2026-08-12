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
        Schema::create('pelanggaran_siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade'); // FK ke siswas.id[cite: 8]
            $table->foreignId('jenis_pelanggaran_id')->constrained('jenis_pelanggarans')->onDelete('cascade'); // FK ke jenis_pelanggarans.id[cite: 8]
            $table->date('tanggal_kejadian'); // date[cite: 8]
            $table->text('deskripsi'); // text[cite: 8]
            $table->integer('poin'); // integer (snapshot poin)[cite: 8]
            $table->foreignId('dicatat_oleh')->constrained('users')->onDelete('cascade'); // FK ke users.id (BK)[cite: 8]
            $table->enum('status', ['menunggu_persetujuan', 'disetujui', 'ditolak', 'selesai']); // enum[cite: 8]
            $table->text('rencana_tindak_lanjut')->nullable(); // text, nullable[cite: 8]
            $table->foreignId('disetujui_oleh')->nullable()->constrained('users')->onDelete('set null'); // FK ke users.id (Waka Kesiswaan), nullable[cite: 8]
            $table->dateTime('tanggal_persetujuan')->nullable(); // datetime, nullable[cite: 8]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggaran_siswas');
    }
};
