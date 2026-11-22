<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Buku extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $fillable = [
        'judul',
        'penulis',
        'harga',
        'tgl_terbit',
        'cover',
        'buku_seo',
        'foto',
    ];

    protected $casts = [
        'tgl_terbit' => 'date',
    ];
    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class, 'buku_id', 'id');
    }

    // Relasi Gallery untuk kebutuhan SEO
    public function photos(): HasMany
    {
    return $this->hasMany(Gallery::class, 'buku_id', 'id');
    }
}