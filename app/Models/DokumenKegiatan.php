<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenKegiatan extends Model
{
    use HasFactory;
    protected $table = 'dokumen_kegiatan';
    protected $fillable = ['kegiatan_id', 'nama_dokumen'];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id');
    }

    public function fileDokumenKegiatans()
    {
        return $this->hasMany(FileDokumenKegiatan::class);
    }
}
