<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pusat extends Model
{
    use HasFactory;
    protected $table = 'pusat';

    public function users()
    {
        return $this->hasMany(User::class,'pusat_id');
    }
}
