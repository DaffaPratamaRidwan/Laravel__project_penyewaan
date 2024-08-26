<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('name', 'admin')->first();
        $penyewaRole = Role::where('name', 'penyewa')->first();
        $keuanganRole = Role::where('name', 'direktur keuangan')->first();
        $operasionalRole = Role::where('name', 'direktur operasional')->first();
        $pmRole = Role::where('name', 'project manager')->first();

        User::create([
            'name' => 'Admin User',
            'nama_perusahaan' => 'PT Sarkon Bangun Nusantara',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => $adminRole->id,
        ]);

        User::create([
            'name' => 'Penyewa User',
            'nama_perusahaan' => 'PT Caterpillar Indonesia',
            'email' => 'penyewa@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => $penyewaRole->id,
        ]);

        User::create([
            'name' => 'Daffa Pratama Ridwan',
            'nama_perusahaan' => 'PT Caterpillar Indonesia',
            'email' => 'daffa@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => $penyewaRole->id,
        ]);

        User::create([
            'name' => 'Fitri Yuliati',
            'nama_perusahaan' => 'PT Sarkon Bangun Nusantara',
            'email' => 'fitri@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => $keuanganRole->id,
        ]);

        User::create([
            'name' => 'Asep Kurniawan',
            'nama_perusahaan' => 'PT Sarkon Bangun Nusantara',
            'email' => 'asep@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => $operasionalRole->id,
        ]);

        User::create([
            'name' => 'Gerald Gates',
            'nama_perusahaan' => 'PT Sarkon Bangun Nusantara',
            'email' => 'gerald@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => $pmRole->id,
        ]);
    }
}
