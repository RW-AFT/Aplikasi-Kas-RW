<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    protected $table = 'wargas';

    protected $fillable = [
        'nama',
        'nik',
        'rt',
        'rw',
        'alamat',
        'telepon',
        'status',
    ];

    public function iurans()
    {
        return $this->hasMany(Iuran::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
