<?php

namespace Database\Seeders\advo_seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AdvoStatus;

class AdvoStatusSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['id_status' => 'STS1', 'status' => 'Belum Diproses'],
            ['id_status' => 'STS2', 'status' => 'Sedang Diproses'],
            ['id_status' => 'STS3', 'status' => 'Ditunda'],
            ['id_status' => 'STS4', 'status' => 'Selesai']
        ];
        
        foreach($data as $status) {
            AdvoStatus::create([
                'id_status' => $status['id_status'],
                'status' => $status['status']
            ]);
        }
    }
}
