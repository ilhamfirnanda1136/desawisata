<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class masteraparat extends Model
{
    use HasFactory;
    protected $table = 'masteraparat';
    protected $fillable = ['jabatan'];
}
