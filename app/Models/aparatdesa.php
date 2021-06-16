<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aparatdesa extends Model
{
    use HasFactory;
    protected $table = 'aparatdesa';
    protected $fillable = [
        'wisata_id',
        'masteraparat_id',
        'nama',
        'jenis_kelamin',
        'alamat',
        'email',
        'notelp',
        'foto',
        'user_id',
    ];

    public function wisata()
    {
        return $this->belongsTo(wisata::class);
    }
    public function masteraparat()
    {
        return $this->belongsTo(masteraparat::class);
    }
}
