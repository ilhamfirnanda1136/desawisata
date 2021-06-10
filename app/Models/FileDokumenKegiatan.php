<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileDokumenKegiatan extends Model
{
    use HasFactory;
    protected $table = 'file_dokumen_kegiatan';
    protected $fillable = ['dokumen_kegiatan_id', 'filename'];

    public function dokumenKegiatan()
    {
        return $this->belongsTo(DokumenKegiatan::class, 'dokumen_kegiatan_id');
    }
}
