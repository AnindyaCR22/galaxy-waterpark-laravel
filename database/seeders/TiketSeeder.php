<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tiket; 

class TiketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tiket::truncate();

        $daftar_tiket = [
            ['nama' => 'Tiket Masuk Dewasa (Weekday)', 'kategori' => 'Reguler', 'harga' => 35000],
            ['nama' => 'Tiket Masuk Dewasa (Weekend)', 'kategori' => 'Reguler', 'harga' => 45000],
            ['nama' => 'Tiket Masuk Anak-Anak (Weekday)', 'kategori' => 'Anak-anak', 'harga' => 25000],
            ['nama' => 'Tiket Masuk Anak-Anak (Weekend)', 'kategori' => 'Anak-anak', 'harga' => 35000],
            ['nama' => 'Paket Rombongan Sekolah (Min. 30 Pax)', 'kategori' => 'Rombongan', 'harga' => 20000],
            ['nama' => 'Paket Rombongan Umum (Min. 20 Pax)', 'kategori' => 'Rombongan', 'harga' => 30000],
            ['nama' => 'Tiket VIP Fast Track + Cabana', 'kategori' => 'VIP', 'harga' => 120000],
            ['nama' => 'Tiket VIP All Access + Loker', 'kategori' => 'VIP', 'harga' => 150000],
            ['nama' => 'Promo Family Pass (2 Dewasa + 2 Anak)', 'kategori' => 'Promo', 'harga' => 110000],
            ['nama' => 'Promo Pelajar/Mahasiswa (KTP/KTM)', 'kategori' => 'Promo', 'harga' => 25000],
            ['nama' => 'Tiket Terusan Wahana Ekstrem', 'kategori' => 'Reguler', 'harga' => 60000],
            ['nama' => 'Tiket Kolam Arus & Wave Pool', 'kategori' => 'Reguler', 'harga' => 40000],
            ['nama' => 'Paket Outbound & Waterpark Kids', 'kategori' => 'Anak-anak', 'harga' => 50000],
            ['nama' => 'Sewa Gazebo VIP (Full Day)', 'kategori' => 'VIP', 'harga' => 1000000],
            ['nama' => 'Tiket Masuk Lansia (> 60 Tahun)', 'kategori' => 'Reguler', 'harga' => 20000],
            ['nama' => 'Paket Ulang Tahun (Sewa Kolam + Snack)', 'kategori' => 'Promo', 'harga' => 2000000],
            ['nama' => 'Paket Rombongan Corporate Gathering', 'kategori' => 'Rombongan', 'harga' => 40000],
            ['nama' => 'Tiket Night Pool Party Event', 'kategori' => 'Promo', 'harga' => 75000],
            ['nama' => 'Tiket Kursus Renang + Masuk Waterpark', 'kategori' => 'Anak-anak', 'harga' => 85000],
            ['nama' => 'Annual Pass Galaxy Waterpark (1 Tahun)', 'kategori' => 'VIP', 'harga' => 3500000],
        ];

        foreach ($daftar_tiket as $tiket) {
            Tiket::create([
                'nama' => $tiket['nama'],
                'kategori' => $tiket['kategori'],
                'harga' => $tiket['harga'],
                'tgl_berlaku' => fake()->dateTimeBetween('-1 month', '+3 months')->format('Y-m-d'),
            ]);
        }
    }
}
