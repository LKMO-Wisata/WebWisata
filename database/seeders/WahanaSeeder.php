<?php

namespace Database\Seeders;

use App\Models\Wahana;
use App\Models\WahanaPhoto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class WahanaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Bumper Cars',
                'deskripsi' => 'Bumper Blast adalah wahana adu seru mobil listrik ...',
                'ketentuan' => [
                    'Usia: minimal 15 tahun',
                    'Tinggi badan: Minimal 130 cm untuk mengemudi sendiri',
                    'kapasitas per mobil: 1-2 orang (maksimum 150 kg total)'
                ],
                'gambar' => [
                    'img/wahana/Bumper Cars/1.jpeg',
                    'img/wahana/Bumper Cars/2.jpeg',
                    'img/wahana/Bumper Cars/3.jpeg',
                    'img/wahana/Bumper Cars/4.jpeg',
                ],
            ],
            [
                'nama' => 'Drop Tower',
                'deskripsi' => 'Drop Tower adalah wahana pemacu adrenalin ...',
                'ketentuan' => [
                    'Usia: minimal 15 tahun',
                    'Tinggi badan: 130 -190 cm',
                    'Kesehatan: Tidak untuk yang memiliki masalah jantung, tekanan darah tinggi, atau kondisi medis tertentu',
                    'Berat maksimal: 100 kg',
                    'kapasitas per sesi: 12-16 orang'
                ],
                'gambar' => [
                    'img/wahana/Drop Tower/1.jpeg',
                    'img/wahana/Drop Tower/2.jpeg',
                    'img/wahana/Drop Tower/3.jpeg',
                    'img/wahana/Drop Tower/4.jpeg',
                ],
            ],
            [
                'nama' => 'Fantasy Voyage',
                'deskripsi' => 'Fantasy Voyage adalah wahana perahu indoor penuh warna ...',
                'ketentuan' => [
                    'Usia: Semua umur (disarankan mulai 4 tahun ke atas)',
                    'Tinggi badan: Tidak ada batas minimum',
                    'Kapasitas per perahu: 6-8 orang'
                ],
                'gambar' => [
                    'img/wahana/Fantasy Voyage/1.jpeg',
                    'img/wahana/Fantasy Voyage/2.jpeg',
                    'img/wahana/Fantasy Voyage/3.jpeg',
                    'img/wahana/Fantasy Voyage/4.jpeg',
                ],
            ],
            [
                'nama' => 'Twinkle Carousel',
                'deskripsi' => 'Twinkle Carousel adalah komidi putar klasik ...',
                'ketentuan' => [
                    'Usia: Semua umur (disarankan mulai 3 tahun ke atas) Anak di bawah 5 tahun wajib didampingi orang tua',
                    'Tinggi badan: Tidak ada batas minimum',
                    'Kapasitas: ±40 orang per sesi',
                ],
                'gambar' => [
                    'img/wahana/Twinkle Carousel/1.jpeg',
                    'img/wahana/Twinkle Carousel/2.jpeg',
                    'img/wahana/Twinkle Carousel/3.jpeg',
                    'img/wahana/Twinkle Carousel/4.jpeg',
                ],
            ],
        ];

        foreach ($data as $row) {
            $slug = Str::slug($row['nama']);
            $wahana = Wahana::updateOrCreate(
                ['slug' => $slug],
                [
                    'nama' => $row['nama'],
                    'deskripsi' => $row['deskripsi'],
                    'ketentuan' => $row['ketentuan'],
                    'is_active' => true,
                ]
            );

            // hapus foto lama agar idempotent
            $wahana->photos()->delete();

            foreach ($row['gambar'] as $i => $path) {
                $wahana->photos()->create([
                    'path' => $path, // tetap pakai public asset lama (img/...), aman
                    'ordering' => $i,
                    'is_primary' => $i === 0,
                ]);
            }
        }
    }
}
