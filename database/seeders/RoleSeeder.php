<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'direktur keuangan']);
        Role::create(['name' => 'direktur operasional']);
        Role::create(['name' => 'project manager']);
        Role::create(['name' => 'penyewa']);
    }
}
