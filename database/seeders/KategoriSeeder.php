<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategoris')->insert([
            ['nama' => 'Undangan', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Pengumuman', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Nota Dinas', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Pemberitahuan', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
