<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WahanaController extends Controller
{
    /**
     * Fungsi helper untuk menyimpan semua data wahana.
     * Nanti, ini bisa diganti dengan panggilan database (Wahana::all())
     */
    private function getMasterWahanaData()
    {
        return [
            [
                'nama_tampil' => 'Fantasy Voyage',
                'nama_folder' => 'Fantasy Voyage',
                'deskripsi' => 'Fantasy Voyage adalah wahana perahu indoor penuh warna dan imajinasi di Zona Fantasi Cahaya. Pengunjung akan berlayar melewati dunia cahaya ajaib dengan karakter lucu, bangunan berkilau, dan musik ceria yang membawa suasana seperti negeri dongeng. Setiap area menggambarkan tema fantasi berbeda, dari kerajaan pelangi hingga hutan bintang',
                'ketentuan' => [
                    'Usia: Semua umur (disarankan mulai 4 tahun ke atas)',
                    'Anak <7 tahun wajib didampingi orang tua',
                    'Tinggi badan: Tidak ada batas minimum',
                    'Kapasitas per perahu: 6–8 orang',
                ],
            ],
            [
                'nama_tampil' => 'TrampoLand',
                'nama_folder' => 'Trampland', // Sesuai nama folder (L kecil)
                'deskripsi' => 'TrampoLand adalah wahana permainan yang dirancang untuk anak-anak dan remaja. Di sini, pengunjung bisa melompat bebas di atas trampolin raksasa yang saling terhubung. Wahana ini menawarkan sensasi menyenangkan sekaligus melatih keseimbangan, kelincahan, dan koordinasi tubuh. Dengan area yang luas dan aman, TrampoLand menjadi tempat favorit untuk melepas energi dan bersenang-senang bersama teman atau keluarga.',
                'ketentuan' => [
                    'Usia: Minimal 5 tahun',
                    'Anak <7 tahun wajib didampingi orang tua',
                    'Tinggi badan: Minimal 100 cm',
                ],
            ],
            [
                'nama_tampil' => 'Drop Tower',
                'nama_folder' => 'Drop Tower',
                'deskripsi' => 'Drop Tower adalah wahana pemacu adrenalin yang membawa pengunjung naik ke puncak menara setinggi puluhan meter sebelum dijatuhkan dengan kecepatan tinggi secara tiba-tiba! Sensasi melayang seolah kehilangan gravitasi menjadikan wahana ini favorit bagi para pencinta tantangan ekstrem. Dari atas menara, pengunjung juga bisa menikmati pemandangan seluruh area taman sebelum terjun bebas ke bawah.',
                'ketentuan' => [
                    'Usia: Minimal 15 tahun',
                    'Tinggi badan: 130 – 190 cm',
                    'Berat badan maksimal: 100 kg',
                    'Kapasitas per sesi: 12–16 orang',
                ],
            ],
            [
                'nama_tampil' => 'Pirate Ship',
                'nama_folder' => 'Pirate Ship',
                'deskripsi' => 'Pirate Ship adalah wahana klasik berbentuk kapal bajak laut raksasa yang berayun maju-mundur dengan kecepatan tinggi! Saat kapal mulai bergerak perlahan, pengunjung akan merasakan sensasi ringan di perut, lalu semakin tinggi ayunan, adrenalin pun meningkat seolah sedang diterpa ombak besar di lautan lepas.',
                'ketentuan' => [
                    'Usia: Minimal 10 tahun',
                    'Tinggi badan: Minimal 130 cm',
                    'Kapasitas: ±24 orang per sesi',
                ],
            ],
            [
                'nama_tampil' => 'Rush Rider',
                'nama_folder' => 'Rush Rider',
                'deskripsi' => 'Rush Rider adalah wahana roller coaster berkecepatan tinggi yang membawa pengunjung meluncur di jalur penuh tikungan tajam, tanjakan ekstrem, dan turunan vertikal yang memacu adrenalin. Terinspirasi dari energi dan kecepatan kilat, wahana ini memberikan sensasi melawan gravitasi dalam waktu singkat namun intens. Suara raungan rel dan hembusan angin menambah suasana mendebarkan sejak awal perjalanan hingga akhir lintasan.',
                'ketentuan' => [
                    'Usia: Minimal 12 tahun',
                    'Tinggi badan: Minimal 135 cm',
                    'Kapasitas per kereta: 12–16 orang',
                ],
            ],
            [
                'nama_tampil' => 'Bumper Cars',
                'nama_folder' => 'Bumper Cars',
                'deskripsi' => 'Bumper Blast adalah wahana adu seru mobil listrik yang dirancang khusus untuk pengunjung remaja dan dewasa. Setiap pengemudi dapat mengendalikan mobilnya di arena tertutup dan menabrakkan mobil lain dengan aman menggunakan sistem bemper pelindung tebal. Musik upbeat, lampu warna-warni, dan suara dentuman membuat suasana semakin seru dan kompetitif.',
                'ketentuan' => [
                    'Usia: Minimal 15 tahun',
                    'Tinggi badan: Minimal 130 cm untuk mengemudi sendiri',
                    'Kapasitas per mobil: 1–2 orang (maksimum 150 kg total)',
                ],
            ],
            [
                'nama_tampil' => 'Mini Bumper Blast',
                'nama_folder' => 'Mini Bumper Blast',
                'deskripsi' => 'Mini Bumper Blast adalah versi anak-anak dari wahana bom-bom car klasik. Dirancang dengan ukuran mobil yang lebih kecil, kecepatan lebih aman, dan arena yang penuh warna, wahana ini memberikan pengalaman mengemudi seru dan aman untuk si kecil. Dengan lampu cerah, musik ceria, dan desain mobil lucu bergaya kartun, anak-anak bisa belajar mengendalikan arah sambil bermain dan tertawa bersama teman-teman mereka.',
                'ketentuan' => [
                    'Usia: 4–10 tahun',
                    'Tinggi badan: Minimal 100 cm',
                    'Kapasitas per mobil: 1 anak',
                    'Durasi permainan: ±3 menit per sesi',
                    'Anak di bawah 7 tahun disarankan didampingi orang tua dari luar arena',
                ],
            ],
            [
                'nama_tampil' => 'Twinkle Carousel',
                'nama_folder' => 'Twinkle Carousel',
                'deskripsi' => 'Twinkle Carousel adalah komidi putar klasik yang dipenuhi lampu berkilau dan musik lembut, menciptakan suasana dongeng yang hangat dan menyenangkan. Pengunjung dapat memilih menunggangi kuda, mobil, kereta, atau hewan fantasi berwarna pastel yang bergerak naik-turun seiring putaran lembut wahana. Dengan desain penuh ornamen keemasan dan lampu LED berbentuk bintang, wahana ini menjadi daya tarik utama bagi anak-anak dan keluarga yang ingin merasakan nostalgia masa kecil dalam suasana penuh cahaya dan keceriaan.',
                'ketentuan' => [
                    'Usia: Semua umur (disarankan mulai 3 tahun ke atas)',
                    'Anak di bawah 5 tahun wajib didampingi orang tua',
                    'Tinggi badan: Tidak ada batas minimum',
                    'Kapasitas: ±40 orang per sesi',
                ],
            ],
            [
                'nama_tampil' => 'Sky Wheel',
                'nama_folder' => 'Sky Wheel',
                'deskripsi' => 'Sky Wheel adalah wahana kincir ria yang menawarkan pengalaman menikmati pemandangan dari ketinggian dengan suasana santai dan menyenangkan. Setiap gondola berputar perlahan membawa pengunjung ke atas, memberikan panorama indah dari seluruh area taman bermain. Wahana ini dilengkapi dengan pencahayaan warna-warni yang menambah kesan estetis, terutama pada malam hari.',
                'ketentuan' => [
                    'Usia: di atas 15 tahun',
                    'Tinggi badan: Minimal 140 cm',
                    'Kapasitas per gondola: 2 orang dewasa',
                ],
            ],
            [
                'nama_tampil' => 'Swan Lake Paddle',
                'nama_folder' => 'Swan Lake Paddle',
                'deskripsi' => 'Swan Lake Paddle adalah wahana perahu berbentuk angsa yang mengajak pengunjung berkeliling di danau buatan yang tenang dan indah. Dengan cara mengayuh pedal sendiri, pengunjung dapat menikmati pemandangan taman sambil bersantai di atas air. Desain perahunya yang elegan dan warna-warna lembut menjadikan wahana ini cocok untuk keluarga, pasangan, maupun anak-anak yang ingin menikmati suasana damai.',
                'ketentuan' => [
                    'Usia: Minimal 7 tahun',
                    'Anak di bawah 15 tahun wajib didampingi orang dewasa',
                    'Kapasitas per perahu: 2 orang',
                    'Durasi permainan: ±10–15 menit',
                ],
            ],
            [
                'nama_tampil' => 'Rapid River Splash',
                'nama_folder' => 'Rapid River Splash',
                'deskripsi' => 'Rapid River Splash adalah wahana arung jeram buatan yang membawa pengunjung menyusuri lintasan air penuh kejutan, mulai dari arus deras, gelombang buatan, air terjun mini, hingga tikungan tajam yang memacu adrenalin! Pengunjung duduk di atas perahu bundar besar yang berputar mengikuti arus, menciptakan pengalaman tak terduga di setiap sudutnya. Dengan efek percikan air dan semburan dari tebing buatan, wahana ini memberikan sensasi basah, seru, dan menegangkan sekaligus menyegarkan.',
                'ketentuan' => [
                    'Usia: Minimal 10 tahun',
                    'Tinggi badan: Minimal 130 cm',
                    'Kapasitas per perahu: 6–8 orang',
                    'Durasi permainan: ±5–7 menit',
                ],
            ],
            [
                'nama_tampil' => 'Mini Glowtopus Spin',
                'nama_folder' => 'Mini Glowtopus Spin',
                'deskripsi' => 'Mini Glowtopus Spin adalah versi anak-anak dari wahana Glowtopus Spin yang penuh warna dan lampu neon. Wahana ini menghadirkan gurita raksasa lucu dengan tangan-tangan yang mengangkat dan memutar kursi mini berisi 2 anak di setiap lengannya. Gerakannya lembut dan berirama, ditemani musik ceria serta efek cahaya berwarna-warni yang membuat anak-anak merasa seperti sedang terbang di bawah laut bercahaya.',
                'ketentuan' => [
                    'Usia: 4–10 tahun',
                    'Tinggi badan: Minimal 95 cm',
                    'Kapasitas kursi: 2 anak per kursi',
                    'Anak di bawah 7 tahun wajib didampingi orang tua dari luar area',
                ],
            ],
        ];
    }

    /**
     * Menampilkan daftar semua wahana (wahana.blade.php)
     */
    public function index(Request $request)
    {
        $wahanaData = $this->getMasterWahanaData();
        
        // Fitur Search (Opsional, tapi bagus untuk ditambahkan)
        if ($request->has('search')) {
            $searchTerm = strtolower($request->get('search'));
            $wahanaData = array_filter($wahanaData, function($wahana) use ($searchTerm) {
                return str_contains(strtolower($wahana['nama_tampil']), $searchTerm);
            });
        }

        return view('wahana', ['wahanaList' => $wahanaData]);
    }

    /**
     * Menampilkan detail satu wahana (detail.blade.php)
     */
    public function show($nama)
    {
        $semuaWahana = $this->getMasterWahanaData();
        
        // 1. Ubah data array menjadi Laravel Collection agar lebih mudah dicari
        $collection = collect($semuaWahana);

        // 2. Cari wahana yang cocok berdasarkan 'nama_tampil'
        $wahana = $collection->firstWhere('nama_tampil', $nama);

        // 3. Jika wahana tidak ditemukan, kembali ke halaman utama
        if (!$wahana) {
            abort(404);
        }

        // 4. Ambil wahana lainnya (kecuali yang sedang dilihat)
        $wahanaLainnya = $collection->where('nama_tampil', '!=', $nama)->all();
        
        // 5. Kirim data wahana yang ditemukan dan daftar wahana lainnya ke view
        return view('detail', [
            'wahana' => $wahana,
            'wahanaLainnya' => $wahanaLainnya
        ]);
    }
}