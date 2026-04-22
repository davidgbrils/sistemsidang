<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model untuk menyimpan data Formulir Sidang (Absen, Rekap, Revisi).
 * 
 * @property int $id
 * @property int $jadwal_id
 * @property int $dosen_id
 * @property string $tipe
 * @property array|null $data
 * @property string|null $file_path
 * @property string|null $submitted_at
 */
class FormulirSidang extends Model
{
    use HasFactory;

    protected $table = 'formulir_sidang';

    protected $fillable = [
        'jadwal_id',
        'dosen_id',
        'tipe',
        'data',
        'file_path',
        'submitted_at',
    ];

    protected $casts = [
        'data' => 'array',
        'submitted_at' => 'datetime',
    ];

    /**
     * Relasi ke model JadwalSidang.
     */
    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(JadwalSidang::class, 'jadwal_id');
    }

    /**
     * Relasi ke model Dosen.
     */
    public function dosen(): BelongsTo
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }
}
