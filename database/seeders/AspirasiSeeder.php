<?php

namespace Database\Seeders;

use App\Models\Aspirasi;
use App\Models\Vote;
use App\Models\Tanggapan;
use Illuminate\Database\Seeder;

class AspirasiSeeder extends Seeder
{
    public function run(): void
    {
        $aspirasi = [
            [
                'user_id' => 2, 'kategori_id' => 2, 'judul' => 'Ruang Belajar Tambahan di Sayap Utara',
                'isi' => 'Kapasitas perpustakaan saat ini sering terlampaui saat ujian. Kami mengusulkan untuk mengubah ruang santai di Sayap Utara yang kurang dimanfaatkan menjadi zona belajar tenang.',
                'status' => 'diterima', 'views_count' => 1204, 'is_anonim' => false,
            ],
            [
                'user_id' => 3, 'kategori_id' => 1, 'judul' => 'Akses Perpustakaan Digital untuk Alumni',
                'isi' => 'Memperluas akses sumber daya online kepada siswa yang sudah lulus untuk mendukung pembelajaran seumur hidup dan pengembangan profesional setelah kelulusan.',
                'status' => 'diproses', 'views_count' => 892, 'is_anonim' => false,
            ],
            [
                'user_id' => 4, 'kategori_id' => 6, 'judul' => 'Inisiatif Kampus Berkelanjutan',
                'isi' => 'Memperkenalkan tempat sampah kompos di semua area kantin dan mengurangi plastik sekali pakai di seluruh mesin penjual kampus.',
                'status' => 'pending', 'views_count' => 156, 'is_anonim' => false,
            ],
            [
                'user_id' => 2, 'kategori_id' => 5, 'judul' => 'Lab Riset Neural Networks Tingkat Lanjut',
                'isi' => 'Meminta akses ke lab riset neural networks dengan perangkat keras GPU untuk proyek akhir tahun.',
                'status' => 'diterima', 'views_count' => 1200, 'is_anonim' => false,
            ],
            [
                'user_id' => 3, 'kategori_id' => 6, 'judul' => 'Program Pilot Taman Kampus Berkelanjutan',
                'isi' => 'Mengusulkan pembuatan taman hijau di area belakang sekolah untuk kegiatan praktikum biologi dan lingkungan.',
                'status' => 'diproses', 'views_count' => 312, 'is_anonim' => false,
            ],
            [
                'user_id' => 4, 'kategori_id' => 1, 'judul' => 'Seri Kuliah Tamu: Masa Depan AI Generatif',
                'isi' => 'Mengundang pembicara ahli dari industri untuk berbagi tentang perkembangan terbaru AI dan dampaknya pada karir.',
                'status' => 'pending', 'views_count' => 88, 'is_anonim' => true,
            ],
        ];

        foreach ($aspirasi as $a) {
            $created = Aspirasi::create($a);

            // Add some votes
            for ($i = 2; $i <= 4; $i++) {
                if (rand(0, 1)) {
                    Vote::create([
                        'user_id' => $i,
                        'aspirasi_id' => $created->id,
                        'type' => rand(0, 4) > 0 ? 'up' : 'down',
                    ]);
                }
            }
        }

        // Add admin responses
        Tanggapan::create([
            'aspirasi_id' => 1,
            'admin_id' => 1,
            'isi' => 'Proposal ini sangat visioner. Kami akan segera meninjau ketersediaan ruang dan mulai renovasi pada semester depan.',
            'is_internal' => false,
        ]);

        Tanggapan::create([
            'aspirasi_id' => 2,
            'admin_id' => 1,
            'isi' => 'Saat ini sedang ditinjau oleh tim IT. Harap berikan rincian lebih lanjut tentang sumber daya yang dibutuhkan.',
            'is_internal' => false,
        ]);
    }
}
