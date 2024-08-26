<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SewaDetail extends Model
{
    use HasFactory;

    protected $table = 'sewa_detail';

    protected $fillable = [
        'sewa_id',
        'alat_berat_id',
        'jumlah',
    ];

    public function sewa()
    {
        return $this->belongsTo(Sewa::class);
    }

    public function alatBerat()
    {
        return $this->belongsTo(AlatBerat::class);
    }
}

