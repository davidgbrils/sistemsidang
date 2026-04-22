<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model untuk menyimpan data Nilai Sidang.
 * 
 * @property int $id
 * @property int $jadwal_id
 * @property int $dosen_id
 * @property float $komponen_presentasi
 * @property float $komponen_penguasaan
 * @property float $komponen_penulisan
 * @property float $komponen_sikap
 * @property float|null $total_nilai
 * @property string|null $grade
 * @property string|null $catatan_revisi
 * @property string|null $ttd_path
 * @property string|null $submitted_at
 */
class NilaiSidang extends Model
{
    use HasFactory;

    protected $table = 'nilai_sidang';

    protected $fillable = [
        'jadwal_id',
        'dosen_id',
        'komponen_presentasi',
        'komponen_penguasaan',
        'komponen_penulisan',
        'komponen_sikap',
        'total_nilai',
        'grade',
        'catatan_revisi',
        'ttd_path',
        'submitted_at',
    ];

    protected $casts = [
        'komponen_presentasi' => 'decimal:2',
        'komponen_penguasaan' => 'decimal:2',
        'komponen_penulisan' => 'decimal:2',
        'komponen_sikap' => 'decimal:2',
        'total_nilai' => 'decimal:2',
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
