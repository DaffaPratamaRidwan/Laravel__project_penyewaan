<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatBerat extends Model
{
    use HasFactory;

    protected $table = 'alat_berat';

    protected $fillable = [
        'nama',
        'merk', 
        'kode',
        'gambar', 
        'deskripsi', 
        'stok',
        'harga_sewa',
    ];

    public function penyewaan()
    {
        return $this->hasMany(Penyewaan::class);
    }
}
