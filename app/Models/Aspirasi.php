<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aspirasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'aspirasi';

    protected $fillable = [
        'user_id', 'kategori_id', 'judul', 'isi', 'status',
        'is_anonim', 'prioritas', 'views_count',
    ];

    protected function casts(): array
    {
        return [
            'is_anonim' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function upvotes()
    {
        return $this->votes()->where('type', 'up');
    }

    public function downvotes()
    {
        return $this->votes()->where('type', 'down');
    }

    public function lampiran()
    {
        return $this->hasMany(Lampiran::class);
    }

    public function scopeTrending($query)
    {
        return $query->withCount(['upvotes', 'downvotes'])
            ->orderByRaw('(upvotes_count * 2 + views_count) DESC');
    }

    public function getVoteScoreAttribute(): int
    {
        return $this->upvotes()->count() - $this->downvotes()->count();
    }

    public function incrementViews(): void
    {
        $this->increment('views_count');
    }
}
