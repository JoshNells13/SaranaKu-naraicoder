<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    use HasFactory;

    protected $table = 'tanggapan';

    protected $fillable = ['aspirasi_id', 'admin_id', 'isi', 'is_internal'];

    protected function casts(): array
    {
        return [
            'is_internal' => 'boolean',
        ];
    }

    public function aspirasi()
    {
        return $this->belongsTo(Aspirasi::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
