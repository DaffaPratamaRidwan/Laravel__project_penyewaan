<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KendaraanPengantar extends Model
{
    use HasFactory;

    protected $table = 'kendaraan_pengantar';
    
    protected $fillable = ['jenis', 'no_pol'];

}
