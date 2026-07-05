<?php

namespace Database\Seeders\advo_seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\AdvoStruktur;
use Faker\Factory as Faker;

class AdvoStrukturSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $password = "1234";
        $folderFoto = 'anggota';

        // Kita buat skema jabatan fungsionaris yang terstruktur
        $jabatans = [
            'Ketua Komisi Advokasi',
            'Sekretaris Komisi Advokasi',
            'Fungsionaris Komisi Advokasi',
            'Fungsionaris Komisi Advokasi',
            'Fungsionaris Komisi Advokasi',
            'Fungsionaris Komisi Advokasi',
        ];

        foreach ($jabatans as $index => $jabatan) {
            // Membuat nama depan acak untuk panggilan
            $namaDepan = $faker->firstName;
            $namaLengkap = $namaDepan . ' ' . $faker->lastName;

            AdvoStruktur::create([
                // Membuat NIM FTI UKSW acak (misal: 672022001, dst)
                'nim' => '672022' . str_pad($index + 10, 3, '0', STR_PAD_LEFT),
                'foto' => $folderFoto . '/' . strtolower($namaDepan) . '.png',
                'nama' => $namaLengkap,
                'panggilan' => $namaDepan,
                'jabatan' => $jabatan,
                'status_lantik' => true,
                'password' => Hash::make($password),
                'logged_in' => false
            ]);
        }
    }
}
