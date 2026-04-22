<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model SkDokumen
 * 
 * Model ini menyimpan data Surat Keputusan (SK) atau dokumen resmi 
 * terkait jadwal sidang yang telah diterbitkan.
 */
class SkDokumen extends Model
{
    use HasFactory;

    protected $table = 'sk_dokumen';

    protected $fillable = [
        'jadwal_id',
        'file_path',
        'generated_at',
        'generated_by',
    ];

    protected $casts = [
        'generated_at' => 'datetime',
    ];

    /**
     * Relasi ke Jadwal Sidang
     */
    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(JadwalSidang::class, 'jadwal_id');
    }

    /**
     * Relasi ke User pembuat dokumen
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'generated_by');
    }
}
