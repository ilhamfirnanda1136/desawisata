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
    ];

    public function dokumenKegiatans()
    {
        return $this->hasMany(DokumenKegiatan::class);
    }
}
