<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AlatBerat;

class AlatBeratSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $alatBerats = [
            [
                'nama' => 'Bulldozer PC75',
                'merk' => 'Sany',
                'kode' => 'BLDZ-hp1120',
                'gambar' => 'bulldozer.jpg',
                'deskripsi' => 'is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
                'stok' => 10,
                'harga_sewa' => 5000000
            ],
            [
                'nama' => 'Excavator E30',
                'merk' => 'CAT',
                'kode' => 'EXC-hfsa123420',
                'gambar' => 'excavator.jpg',
                'deskripsi' => 'Deskripsi excavator.',
                'stok' => 3,
                'harga_sewa' => 7500000
            ],
            [
                'nama' => 'Crane Boom E30',
                'merk' => 'Dooms',
                'kode' => 'CRNBOOM-iuoha352',
                'gambar' => 'craneboom.jpg',
                'deskripsi' => 'is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
                'stok' => 14,
                'harga_sewa' => 8000000
            ],
            [
                'nama' => 'Grader G11',
                'merk' => 'Komatsu',
                'kode' => 'GRD-g11',
                'gambar' => 'grader.jpg',
                'deskripsi' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'stok' => 5,
                'harga_sewa' => 6000000
            ],
            [
                'nama' => 'Pile Driving Hammers H5',
                'merk' => 'Kobe',
                'kode' => 'PLDRVHAM-h5',
                'gambar' => 'pile-driving-hammers.jpg',
                'deskripsi' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'stok' => 3,
                'harga_sewa' => 17000000
            ],
            [
                'nama' => 'Roller Road R33',
                'merk' => 'Mitsubishi',
                'kode' => 'RR-r33',
                'gambar' => 'roller-road.jpg',
                'deskripsi' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'stok' => 20,
                'harga_sewa' => 1000000
            ],
            [
                'nama' => 'Scraper S24',
                'merk' => 'CAT',
                'kode' => 'SCR-s24',
                'gambar' => 'scraper.jpg',
                'deskripsi' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'stok' => 9,
                'harga_sewa' => 3000000
            ]
        ];

        foreach ($alatBerats as $alatBerat) {
            AlatBerat::create($alatBerat);
        }
    }
}
