<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model untuk menyimpan data Pengajuan Ganti Penguji.
 * 
 * @property int $id
 * @property int $jadwal_id
 * @property int $penguji_lama_id
 * @property int $penguji_baru_id
 * @property string $alasan
 * @property string $status
 * @property string|null $alasan_penolakan
 * @property int $requested_by
 * @property int|null $approved_by
 * @property string $requested_at
 * @property string|null $approved_at
 */
class GantiPenguji extends Model
{
    use HasFactory;

    protected $table = 'ganti_penguji';

    protected $fillable = [
        'jadwal_id',
        'penguji_lama_id',
        'penguji_baru_id',
        'alasan',
        'status',
        'alasan_penolakan',
        'requested_by',
        'approved_by',
        'requested_at',
        'approved_at',
    ];

    protected $casts = [
        'requested_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    /**
     * Relasi ke model JadwalSidang.
     */
    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(JadwalSidang::class, 'jadwal_id');
    }

    /**
     * Relasi ke model Dosen sebagai penguji lama.
     */
    public function pengujiLama(): BelongsTo
    {
        return $this->belongsTo(Dosen::class, 'penguji_lama_id');
    }

    /**
     * Relasi ke model Dosen sebagai penguji baru.
     */
    public function pengujiBaru(): BelongsTo
    {
        return $this->belongsTo(Dosen::class, 'penguji_baru_id');
    }

    /**
     * Relasi ke model User yang mengajukan.
     */
    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    /**
     * Relasi ke model User yang menyetujui.
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
