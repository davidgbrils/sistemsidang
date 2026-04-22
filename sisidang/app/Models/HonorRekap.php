<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model HonorRekap
 * 
 * Model ini merepresentasikan rekapitulasi honor dosen untuk periode tertentu
 * berdasarkan jumlah sidang yang telah diikuti.
 */
class HonorRekap extends Model
{
    use HasFactory;

    protected $table = 'honor_rekap';

    protected $fillable = [
        'dosen_id',
        'periode',
        'jumlah_sidang',
        'nominal_per_sidang',
        'total_honor',
        'status',
        'generated_at',
    ];

    protected $casts = [
        'generated_at' => 'datetime',
        'nominal_per_sidang' => 'decimal:2',
        'total_honor' => 'decimal:2',
        'jumlah_sidang' => 'integer',
    ];

    /**
     * Relasi ke Dosen
     */
    public function dosen(): BelongsTo
    {
        return $this->belongsTo(Dosen::class);
    }
}
