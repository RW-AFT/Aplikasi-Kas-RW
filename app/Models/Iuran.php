<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iuran extends Model
{
    use HasFactory;

    protected $table = 'iurans';

    protected $fillable = [
        'warga_id',
        'bulan',
        'tahun',
        'jumlah',
        'status',
        'tanggal_bayar',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }
}
