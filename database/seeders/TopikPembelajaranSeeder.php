<?php

namespace Database\Seeders;

use App\Models\TopikPembelajaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopikPembelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $topikData = [        
            
        ];

        foreach ($topikData as $topik) {
            TopikPembelajaran::firstOrCreate(
                ['slug' => $topik['slug']],
                $topik
            );
        }
    }
}
