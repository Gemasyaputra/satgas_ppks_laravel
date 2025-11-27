<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service; // Pastikan Model Service di-import

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Kosongkan tabel dulu agar tidak duplikat saat di-seed ulang
        // (Hati-hati, ini menghapus data layanan lama)
        Service::truncate(); 

        // 2. Data yang akan dimasukkan (Sesuai Gambar)
        $services = [
            [
                'title'       => 'Hotline Darurat 24/7',
                'description' => 'Layanan bantuan darurat dan pelaporan cepat untuk mahasiswa yang membutuhkan dukungan segera.',
                'icon'        => 'phone', // Keyword untuk icon telepon
                'phone'       => '+6285182056839', // Nomor dari gambar
            ],
            [
                'title'       => 'Email Pengaduan',
                'description' => 'Kanal aduan resmi untuk mengirimkan laporan detail, kronologi, dan bukti dokumen.',
                'icon'        => 'email', // Keyword untuk icon amplop
                'phone'       => 'satgasppkspnp@pnp.ac.id', // Email dari gambar
            ],
            [
                'title'       => 'Instagram Resmi',
                'description' => 'Informasi edukasi, update kegiatan, dan kampanye pencegahan kekerasan seksual.',
                'icon'        => 'instagram', // Keyword untuk icon IG
                'phone'       => '@satgasppkspoltekpadang', // IG dari gambar
            ],
        ];

        // 3. Masukkan data ke database
        foreach ($services as $service) {
            Service::create($service);
        }
    }
}