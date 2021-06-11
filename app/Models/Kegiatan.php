<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kegiatan extends Model
{
    use HasFactory;
    protected $table = 'kegiatan';
    protected $fillable = [
        'project_id',
        'tanggal',
        'nama_kegiatan',
        'keterangan',
        'prosentase_capaian'
    ];

    public function laporanKeuangan()
    {
        return $this->hasOne(LaporanKeuangan::class);
    }

    public function dokumenKegiatans()
    {
        return $this->hasMany(DokumenKegiatan::class);
    }
}
