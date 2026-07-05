<?php

namespace Database\Seeders\advo_seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AdvoKategori;

class AdvoKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $icon = 'icons';
        $png = '.png';

        $data = [
            ['id_kategori' => 'KAT1', 'kategori' => 'Akademik', 'foto' => $icon.'/Akademik'.$png],
            ['id_kategori' => 'KAT2', 'kategori' => 'Administrasi', 'foto' => $icon.'/Administrasi'.$png],
            ['id_kategori' => 'KAT3', 'kategori' => 'Fasilitas', 'foto' => $icon.'/Fasilitas'.$png],
            ['id_kategori' => 'KAT4', 'kategori' => 'Kegiatan Mahasiswa', 'foto' => $icon.'/Kegiatan'.$png],
            ['id_kategori' => 'KAT5', 'kategori' => 'Pelayanan Khusus', 'foto' => $icon.'/Pelayanan'.$png]
        ];
        
        foreach($data as $kategori) {
            AdvoKategori::create([
                'id_kategori' => $kategori['id_kategori'],
                'kategori' => $kategori['kategori'],
                'foto' => $kategori['foto']
            ]);
        }
    }
}
