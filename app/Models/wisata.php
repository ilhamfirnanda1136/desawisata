<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wisata extends Model
{
    use HasFactory;
    protected $table ='wisata';
    protected $fillable = ['pusat_id','nama_desa','kecamatan_id','latitude','langtitude','alamat'];
    public function kecamatan() {
        return $this->belongsTo(kecamatan::class);
    }

    public function aparatdesas()
    {
        return $this->hasMany(aparatdesa::class,'wisata_id');
    }
}
