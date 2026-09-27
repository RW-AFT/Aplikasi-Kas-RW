<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
        'warga_id',
        'jenis',
        'kategori',
        'keterangan',
        'jumlah',
        'tanggal',
        'user_id',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }
}
