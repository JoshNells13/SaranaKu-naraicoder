<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update users role enum
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('murid', 'admin', 'atasan') DEFAULT 'murid'");

        // Update aspirasi status enum
        DB::statement("ALTER TABLE aspirasi MODIFY COLUMN status ENUM('pending', 'diproses', 'menunggu_persetujuan_atasan', 'diterima', 'ditolak') DEFAULT 'pending'");

        // Add estimasi_waktu to aspirasi
        Schema::table('aspirasi', function (Blueprint $table) {
            $table->dateTime('estimasi_waktu')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aspirasi', function (Blueprint $table) {
            $table->dropColumn('estimasi_waktu');
        });

        DB::statement("ALTER TABLE aspirasi MODIFY COLUMN status ENUM('pending', 'diproses', 'diterima', 'ditolak') DEFAULT 'pending'");
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('murid', 'admin') DEFAULT 'murid'");
    }
};
