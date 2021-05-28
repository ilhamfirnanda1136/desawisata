<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kecamatan extends Model
{
    use HasFactory;
    protected $table ='kecamatan';

    public function kota() {
        return $this->belongsTo(kota::class);
    }

    public function wisata() {
        return $this->hasMany(wisata::class);
    }



}
