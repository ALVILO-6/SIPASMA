<?php

namespace Database\Seeders\advo_seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AdvoFAQ;
use App\Models\AdvoKategori;
use Faker\Factory as Faker;

class AdvoFAQSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        
        // Ambil semua kategori yang sudah di-seed oleh AdvoKategoriSeeder
        $daftarKategori = AdvoKategori::all();

        // Contoh template pertanyaan & jawaban umum dunia kampus yang aman untuk portofolio
        $templateFAQ = [
            'Bagaimana prosedur pengajuan keluhan terkait layanan di kategori ini?',
            'Siapa yang harus saya hubungi pertama kali jika terjadi kendala darurat?',
            'Berapa lama estimasi waktu tindak lanjut untuk setiap laporan yang masuk?'
        ];

        foreach ($daftarKategori as $kategori) {
            foreach ($templateFAQ as $pertanyaan) {
                AdvoFAQ::create([
                    'kategori' => $kategori->id_kategori, // Otomatis memakai KAT1, KAT2, dst
                    'pertanyaan' => str_replace('di kategori ini', 'terkait ' . $kategori->kategori, $pertanyaan),
                    'jawaban' => 'Silahkan menghubungi fungsionaris Komisi Advokasi FTI melalui fitur chat atau langsung datang ke kantor sekretariat pada jam kerja.'
                ]);
            }
        }
    }
}
