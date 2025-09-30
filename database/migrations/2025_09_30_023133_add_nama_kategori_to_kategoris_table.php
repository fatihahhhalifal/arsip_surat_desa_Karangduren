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
        Schema::table('kategoris', function (Blueprint $table) {
            // Ubah kolom 'nama' jadi 'nama_kategori'
            $table->renameColumn('nama', 'nama_kategori');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kategoris', function (Blueprint $table) {
            // Balikin lagi kalau rollback
            $table->renameColumn('nama_kategori', 'nama');
        });
    }
};
