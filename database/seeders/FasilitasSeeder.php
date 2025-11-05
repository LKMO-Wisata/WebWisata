<?php

namespace Database\Seeders;

use App\Models\Fasilitas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FasilitasSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'nama' => 'Musholah',
                'deskripsi' => 'Fasilitas tempat ibadah yang bersih dan nyaman tersedia untuk pengunjung.',
                'gambar' => 'Mushollah.jpg',
            ],
            [
                'nama' => 'Parking Lot',
                'deskripsi' => 'Fasilitas tempat parkir yang bersih dan nyaman tersedia untuk pengunjung.',
                'gambar' => 'Parking Lot.jpg',
            ],
            [
                'nama' => 'Gazebo',
                'deskripsi' => 'Fasilitas gazebo yang bersih dan nyaman tersedia untuk pengunjung.',
                'gambar' => 'Gazebo.jpg',
            ],
            [
                'nama' => 'Food Court',
                'deskripsi' => 'Fasilitas food court yang bersih dan nyaman tersedia untuk pengunjung.',
                'gambar' => 'Food Court.jpg',
            ],
            [
                'nama' => 'Toilet',
                'deskripsi' => 'Fasilitas toilet dan locker yang bersih dan nyaman tersedia untuk pengunjung.',
                'gambar' => 'Toilet.jpg',
            ],
        ];

        foreach ($items as $i) {
            Fasilitas::updateOrCreate(
                ['slug' => Str::slug($i['nama'])],
                [
                    'nama'       => $i['nama'],
                    'deskripsi'  => $i['deskripsi'],
                    'gambar'     => 'img/fasilitas/' . $i['gambar'], // path relatif ke public/
                    'is_active'  => true,
                ]
            );
        }
    }
}
