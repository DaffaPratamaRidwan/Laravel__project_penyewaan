<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KendaraanPengantar;

class KendaraanPengantarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KendaraanPengantar::create([
            'jenis' => 'Truck',
            'no_pol' => 'D 2938 UYT',

        ]);

        KendaraanPengantar::create([
            'jenis' => 'Sedan',
            'no_pol' => 'B 1945 EHE',

        ]);

        KendaraanPengantar::create([
            'jenis' => 'Motor',
            'no_pol' => 'N 19 GA',

        ]);

    }
}
