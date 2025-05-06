<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderan extends Model
{
    use HasFactory;

    protected $table = 'orderans';
    protected $primaryKey = 'id';

    protected $fillable = [
        'pelanggan_id',
        'layanan_id',
        'alamat',
        'telepon',
        'email',
        'tanggal',
        'waktu',
        'harga',
        'no_nota',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'harga' => 'integer',
    ];

    // ✅ Relasi ke tabel Pelanggans
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }
}
