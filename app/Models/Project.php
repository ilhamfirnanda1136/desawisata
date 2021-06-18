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
}
