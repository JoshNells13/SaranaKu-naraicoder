<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lampiran extends Model
{
    use HasFactory;

    protected $table = 'lampiran';

    protected $fillable = ['aspirasi_id', 'nama_file', 'path', 'tipe', 'ukuran'];

    public function aspirasi()
    {
        return $this->belongsTo(Aspirasi::class);
    }
}
