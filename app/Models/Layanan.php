<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_layanan',
        'deskripsi',
        'harga',
    ];
    // app/Models/Layanan.php

public function orderans()
{
    return $this->hasMany(Orderan::class);
}

}
