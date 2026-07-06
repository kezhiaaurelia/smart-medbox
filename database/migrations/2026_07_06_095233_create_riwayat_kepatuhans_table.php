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
        Schema::create('riwayat_kepatuhans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('jadwal_minum_obat_id')->constrained('jadwal_minum_obats')->onDelete('cascade');
            $table->date('tanggal');
            $table->time('jam_seharusnya');
            $table->time('jam_diminum')->nullable();
            $table->enum('status', ['tepat_waktu', 'terlambat', 'tidak_diminum'])->default('tidak_diminum');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_kepatuhans');
    }
};
