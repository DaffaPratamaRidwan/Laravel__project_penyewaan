<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sewa extends Model
{
    use HasFactory;

    protected $table = 'sewa';

    protected $fillable = [
        'user_id',
        'nama_perusahaan',
        'alamat',
        'npwp',
        'no_telp',
        'keterangan',
        'tanggal_awal',
        'tanggal_akhir',
        'bukti_bayar',
        'bukti_denda',
        'kontrak',
        'karyawan_id',
        'kendaraan_pengantar_id',
        'disetujui',
        'disetujui_tolak',
        'disetujui_sewa',
        'disetujui_sewa_tolak',
        'pengembalian',
        'pengembalian_diterima',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sewaDetail()
    {
        return $this->hasMany(SewaDetail::class);
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function kendaraanPengantar()
    {
        return $this->belongsTo(KendaraanPengantar::class);
    }
}

