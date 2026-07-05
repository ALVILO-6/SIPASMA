<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\advo_seeders\AdvoStrukturSeeder;
use Database\Seeders\advo_seeders\AdvoKategoriSeeder;
use Database\Seeders\advo_seeders\AdvoStatusSeeder;
use Database\Seeders\advo_seeders\AdvoFAQSeeder;
use Database\Seeders\advo_seeders\AdvoAspirasiSeeder;

class RunSeeder extends Seeder
{
    //Jalankan semua seeder sekaligus
    public function run(): void
    {
        $this->call([
            AdvoStrukturSeeder::class,
            AdvoKategoriSeeder::class,
            AdvoFAQSeeder::class,
            AdvoStatusSeeder::class,
            AdvoAspirasiSeeder::class
        ]);
    }
}
