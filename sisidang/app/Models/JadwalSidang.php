<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Model untuk menyimpan data Jadwal Sidang.
 * 
 * @property int $id
 * @property int $mahasiswa_id
 * @property int $penguji1_id
 * @property int $penguji2_id
 * @property int $pembimbing_id
 * @property string $tanggal
 * @property string $jam_mulai
 * @property string $jam_selesai
 * @property string $ruang
 * @property string $status
 * @property int $created_by
 */
class JadwalSidang extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'jadwal_sidang';

    protected $fillable = [
        'mahasiswa_id',
        'penguji1_id',
        'penguji2_id',
        'pembimbing_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'ruang',
        'status',
        'created_by',
    ];

    /**
     * Relasi ke model Mahasiswa.
     */
    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    /**
     * Relasi ke model Dosen sebagai penguji 1.
     */
    public function penguji1(): BelongsTo
    {
        return $this->belongsTo(Dosen::class, 'penguji1_id');
    }

    /**
     * Relasi ke model Dosen sebagai penguji 2.
     */
    public function penguji2(): BelongsTo
    {
        return $this->belongsTo(Dosen::class, 'penguji2_id');
    }

    /**
     * Relasi ke model Dosen sebagai pembimbing.
     */
    public function pembimbing(): BelongsTo
    {
        return $this->belongsTo(Dosen::class, 'pembimbing_id');
    }

    /**
     * Relasi ke model User yang membuat jadwal.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relasi ke model NilaiSidang.
     */
    public function nilai(): HasMany
    {
        return $this->hasMany(NilaiSidang::class, 'jadwal_id');
    }

    /**
     * Relasi ke model GantiPenguji.
     */
    public function gantiPenguji(): HasMany
    {
        return $this->hasMany(GantiPenguji::class, 'jadwal_id');
    }

    /**
     * Relasi ke model FormulirSidang.
     */
    public function formulir(): HasMany
    {
        return $this->hasMany(FormulirSidang::class, 'jadwal_id');
    }

    /**
     * Relasi ke model SkDokumen.
     */
    public function skDokumen(): HasOne
    {
        return $this->hasOne(SkDokumen::class, 'jadwal_id');
    }
}
