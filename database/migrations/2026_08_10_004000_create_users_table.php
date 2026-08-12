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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade'); // Relasi ke roles.id[cite: 7]
            $table->string('nip_nik')->nullable(); // varchar, nullable[cite: 7]
            $table->string('nama'); // varchar[cite: 7]
            $table->string('email')->unique(); // varchar, unique[cite: 7]
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password'); // varchar[cite: 7]
            $table->foreignId('jurusan_id')->nullable()->constrained('jurusans')->nullOnDelete(); // Relasi ke jurusans.id, nullable[cite: 7]
            $table->boolean('is_koordinator_bk')->default(false); // Penanda khusus koordinator BK[cite: 7]
            $table->string('foto')->nullable(); // varchar, nullable[cite: 7]
            $table->boolean('status_aktif')->default(true); // default true[cite: 7]
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
