<?php

namespace Database\Seeders\advo_seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AdvoAspirasi;
use Faker\Factory as Faker;

class AdvoAspirasiSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil kumpulan ID valid yang sudah ada di database
        $listKategori = AdvoKategori::pluck('id_kategori')->toArray(); // ['KAT1', 'KAT2', ...]
        $listStatus = AdvoStatus::pluck('id_status')->toArray();       // ['STS1', 'STS2', ...]
        $listPJ = AdvoStruktur::pluck('nim')->toArray();               // Mengambil list NIM fungsionaris tiruan

        // Kumpulan aspirasi acak agar data demonstrasi skripsimu terlihat nyata
        $kumpulanAspirasi = [
            'Mohon peninjauan kembali terkait transparansi informasi di lingkungan fakultas.',
            'Fasilitas penunjang perkuliahan harap diperhatikan perawatannya berkala.',
            'Sistem antrean administrasi online terkadang mengalami kendala saat jam sibuk.',
            'Butuh perpanjangan jam operasional layanan pengaduan mahasiswa.',
            'Sosialisasi alur advokasi mahasiswa baru dirasa masih kurang merata.'
        ];

        // Buat 60 data aspirasi palsu secara otomatis
        for ($i = 0; $i < 60; $i++) {
            AdvoAspirasi::create([
                'nama' => $faker->name,
                'nim' => $faker->numerify('67202#####'), // Format NIM acak aman
                'kategori' => $faker->randomElement($listKategori), // Otomatis sinkron ke database
                'aspirasi' => $faker->randomElement($kumpulanAspirasi),
                'status' => $faker->randomElement($listStatus),     // Otomatis sinkron ke database
                'pj' => $faker->randomElement($listPJ),             // Otomatis terelasi ke admin fungsionaris
                'tanggapan' => $faker->randomElement(['Sedang ditinjau.', 'Laporan diterima dan diteruskan ke Sarpras.', 'Selesai ditangani.']),
                'bersedia' => $faker->boolean(85), 
                // Mengacak tanggal dari tahun 2025 sampai awal 2026 agar grafik visualisasinya cantik
                'created_at' => $faker->dateTimeBetween('2025-01-01', '2026-02-28')->format('Y-m-d H:i:s')
            ]);
        }
    }
}