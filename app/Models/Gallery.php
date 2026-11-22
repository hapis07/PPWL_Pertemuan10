<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'galeri';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_galeri',
        'galeri_seo',
        'keterangan',
        'foto',
        'path',
        'buku_id',
    ];

    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class, 'buku_id', 'id');
    }
}
