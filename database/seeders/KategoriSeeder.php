<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            ['nama' => 'Akademik', 'deskripsi' => 'Aspirasi terkait kurikulum dan pembelajaran', 'icon' => 'school'],
            ['nama' => 'Fasilitas', 'deskripsi' => 'Aspirasi terkait infrastruktur dan fasilitas', 'icon' => 'apartment'],
            ['nama' => 'Olahraga', 'deskripsi' => 'Aspirasi terkait kegiatan olahraga', 'icon' => 'sports_soccer'],
            ['nama' => 'Kesejahteraan', 'deskripsi' => 'Aspirasi terkait kesejahteraan siswa', 'icon' => 'favorite'],
            ['nama' => 'Teknologi', 'deskripsi' => 'Aspirasi terkait inovasi teknologi', 'icon' => 'computer'],
            ['nama' => 'Lingkungan', 'deskripsi' => 'Aspirasi terkait lingkungan sekolah', 'icon' => 'eco'],
        ];

        foreach ($kategori as $k) {
            Kategori::create($k);
        }
    }
}
