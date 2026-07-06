<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jadwal_minum_obats', function (Blueprint $table) {
            if (Schema::hasColumn('jadwal_minum_obats', 'jam_minum')) {
                $table->dropColumn('jam_minum');
            }

            if (! Schema::hasColumn('jadwal_minum_obats', 'tipe_frekuensi')) {
                $table->enum('tipe_frekuensi', ['setiap_hari', 'interval_hari'])->default('setiap_hari')->after('obat_id');
            }

            if (! Schema::hasColumn('jadwal_minum_obats', 'interval_hari')) {
                $table->unsignedInteger('interval_hari')->default(1)->after('tipe_frekuensi');
            }

            if (! Schema::hasColumn('jadwal_minum_obats', 'tanggal_mulai')) {
                $table->date('tanggal_mulai')->nullable()->after('interval_hari');
            }
        });

        // Isi tanggal_mulai untuk baris yang sudah ada (kalau ada data lama) biar gak null
        DB::table('jadwal_minum_obats')->whereNull('tanggal_mulai')->update([
            'tanggal_mulai' => now()->format('Y-m-d'),
        ]);
    }

    public function down(): void
    {
        Schema::table('jadwal_minum_obats', function (Blueprint $table) {
            if (! Schema::hasColumn('jadwal_minum_obats', 'jam_minum')) {
                $table->time('jam_minum')->nullable();
            }

            $table->dropColumn(['tipe_frekuensi', 'interval_hari', 'tanggal_mulai']);
        });
    }
};