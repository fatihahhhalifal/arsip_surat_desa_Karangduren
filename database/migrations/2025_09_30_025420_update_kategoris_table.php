<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kategoris', function (Blueprint $table) {
            // Hapus kolom "nama" kalau ada
            if (Schema::hasColumn('kategoris', 'nama')) {
                $table->dropColumn('nama');
            }

            // Tambah kolom "nama_kategori" kalau belum ada
            if (!Schema::hasColumn('kategoris', 'nama_kategori')) {
                $table->string('nama_kategori')->after('id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('kategoris', function (Blueprint $table) {
            // Hapus kolom "nama_kategori" kalau ada
            if (Schema::hasColumn('kategoris', 'nama_kategori')) {
                $table->dropColumn('nama_kategori');
            }

            // Tambah kolom "nama" kalau belum ada
            if (!Schema::hasColumn('kategoris', 'nama')) {
                $table->string('nama')->after('id');
            }
        });
    }
};
