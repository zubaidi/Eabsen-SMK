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
        Schema::create('tindak_lanjut_pelanggarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggaran_id')->constrained('pelanggaran_siswas')->onDelete('cascade'); // FK ke pelanggaran_siswas.id[cite: 8]
            $table->foreignId('oleh_user_id')->constrained('users')->onDelete('cascade'); // FK ke users.id[cite: 8]
            $table->text('catatan'); // text[cite: 8]
            $table->enum('status_baru', ['menunggu_persetujuan', 'disetujui', 'ditolak', 'selesai']); // enum (sama dengan status di pelanggaran_siswas)[cite: 8]
            $table->timestamp('created_at')->useCurrent(); // timestamp[cite: 8]
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate(); // Menyediakan field default untuk update meskipun tidak dispesifikasikan di skema
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tindak_lanjut_pelanggarans');
    }
};
