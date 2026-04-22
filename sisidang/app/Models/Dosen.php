<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model untuk menyimpan data Dosen.
 * 
 * @property int $id
 * @property int $user_id
 * @property string $nip
 * @property string $nama
 * @property string $email
 * @property string $jabatan
 * @property string $prodi
 * @property bool $is_active
 */
class Dosen extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'dosen';

    protected $fillable = [
        'user_id',
        'nip',
        'nama',
        'email',
        'jabatan',
        'prodi',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Relasi ke model User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model Mahasiswa sebagai dosen pembimbing.
     */
    public function bimbingan(): HasMany
    {
        return $this->hasMany(Mahasiswa::class, 'dosen_pembimbing_id');
    }

    /**
     * Relasi ke JadwalSidang sebagai penguji 1.
     */
    public function penguji1(): HasMany
    {
        return $this->hasMany(JadwalSidang::class, 'penguji1_id');
    }

    /**
     * Relasi ke JadwalSidang sebagai penguji 2.
     */
    public function penguji2(): HasMany
    {
        return $this->hasMany(JadwalSidang::class, 'penguji2_id');
    }

    /**
     * Relasi ke JadwalSidang sebagai pembimbing.
     */
    public function pembimbingSidang(): HasMany
    {
        return $this->hasMany(JadwalSidang::class, 'pembimbing_id');
    }
}
