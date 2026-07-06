<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Informasi Akun
            $table->string('foto_profil')->nullable()->after('name');
            $table->string('no_hp')->nullable()->after('email');

            // Informasi Pasien (data diri pemilik akun)
            $table->date('tanggal_lahir')->nullable()->after('no_hp');
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable()->after('tanggal_lahir');
            $table->string('golongan_darah')->nullable()->after('jenis_kelamin');
            $table->text('riwayat_alergi')->nullable()->after('golongan_darah');

            // Kontak Darurat
            $table->string('kontak_darurat_nama')->nullable()->after('riwayat_alergi');
            $table->string('kontak_darurat_hubungan')->nullable()->after('kontak_darurat_nama');
            $table->string('kontak_darurat_hp')->nullable()->after('kontak_darurat_hubungan');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'foto_profil', 'no_hp', 'tanggal_lahir', 'jenis_kelamin',
                'golongan_darah', 'riwayat_alergi',
                'kontak_darurat_nama', 'kontak_darurat_hubungan', 'kontak_darurat_hp',
            ]);
        });
    }
};