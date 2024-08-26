<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Karyawan;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Karyawan::create([
            'name' => 'Asep Sutandra',
            'nip' => '214453218',
        ]);

        Karyawan::create([
            'name' => 'Ucup Sutisno',
            'nip' => '364879112',
        ]);

        Karyawan::create([
            'name' => 'Agus Saripudin',
            'nip' => '214453332',
        ]);

        Karyawan::create([
            'name' => 'Bambang Wisnu',
            'nip' => '364678322',
        ]);

    }
}
