<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'type_project_id',
        'nama_project',
        'tahun_project',
        'nilai_pagu_project',
        'tgl_start',
        'tgl_finish',
    ];

    public function projectType()
    {
        return $this->belongsTo(ProjectType::class, 'type_project_id');
    }

    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function wisata()
    {
        return $this->belongsTo(wisata::class,'wisata_id');
    }
}
