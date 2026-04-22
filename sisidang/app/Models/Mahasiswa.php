<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model untuk menyimpan data Mahasiswa.
 * 
 * @property int $id
 * @property int $user_id
 * @property string $nim
 * @property string $nama
 * @property string $prodi
 * @property string $angkatan
 * @property string|null $judul_skripsi
 * @property int|null $dosen_pembimbing_id
 * @property string $status
 */
class Mahasiswa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mahasiswa';

    protected $fillable = [
        'user_id',
        'nim',
        'nama',
        'prodi',
        'angkatan',
        'judul_skripsi',
        'dosen_pembimbing_id',
        'status',
    ];

    /**
     * Relasi ke model User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model Dosen sebagai dosen pembimbing.
     */
    public function pembimbing(): BelongsTo
    {
        return $this->belongsTo(Dosen::class, 'dosen_pembimbing_id');
    }

    /**
     * Relasi ke JadwalSidang.
     */
    public function jadwalSidang(): HasMany
    {
        return $this->hasMany(JadwalSidang::class);
    }
}
