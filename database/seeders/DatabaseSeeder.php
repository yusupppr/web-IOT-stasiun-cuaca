<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\News;       
use App\Models\Customer; 
use App\Models\TopikPembelajaran;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str; 

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Membuat User Admin untuk Filament Panel
        User::factory()->create([
            'name' => 'Admin Terobos',
            'email' => 'admin@terobos.com',
            'password' => bcrypt('admin123456'),
        ]);

        // 2. Membuat SATU Penulis spesifik 
        $adminAuthor = Customer::factory()->create([
            'name' => 'Admin Terobos',
            'email' => 'admin@terobos.com',
            'password' => bcrypt('password'), 
        ]);

        // 3. Seed Topik Pembelajaran
        $this->call(TopikPembelajaranSeeder::class);
        
        // --- BERITA 1 ---
        $title1 = 'Robotika Menjadi Ekstrakurikuler Unggulan di SMK';
        News::create([
            'customer_id' => $adminAuthor->id, 
            'tanggal' => now(),
            'title' => $title1,
            'slug' => Str::slug($title1),
            'kategory' => 'Edukasi',
            'description' => 'Kegiatan ekstrakurikuler robotika di SMK Negeri 1 Surakarta berhasil menarik minat siswa. Dengan dukungan platform Terobos, siswa kini dapat belajar merakit dan memprogram robot dari komponen daur ulang...',
            'thumbnail' => 'images/banner-image.png' 
        ]);

        // --- BERITA 2 ---
        $title2 = 'Inovasi Baru: Sensor Jarak dari Limbah Elektronik';
        News::create([
            'customer_id' => $adminAuthor->id, 
            'tanggal' => now()->subDays(1),
            'title' => $title2,
            'slug' => Str::slug($title2),
            'kategory' => 'Teknologi',
            'description' => 'Tim Terobos berhasil mengembangkan prototipe sensor jarak ultrasonik baru yang memanfaatkan komponen dari limbah elektronik. Langkah ini diharapkan dapat mengurangi biaya produksi perangkat ajar...',
            'thumbnail' => 'images/banner-image.png' 
        ]);

        // --- BERITA 3 ---
        $title3 = 'Komunitas Terobos Gelar Kompetisi Robotik Pertama';
        News::create([
            'customer_id' => $adminAuthor->id,
            'tanggal' => now()->subDays(2),
            'title' => $title3,
            'slug' => Str::slug($title3),
            'kategory' => 'Komunitas',
            'description' => 'Kompetisi robotik internal pertama Terobos sukses digelar akhir pekan lalu. Acara ini diikuti oleh lebih dari 50 tim dari berbagai sekolah mitra yang memamerkan kreativitas mereka...',
            'thumbnail' => 'images/banner-image.png'
        ]);
    }
}