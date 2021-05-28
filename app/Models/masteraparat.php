<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class masteraparat extends Model
{
    use HasFactory;
    protected $table = 'masteraparat';
    protected $fillable = ['jabatan'];

    public function aparatdesa()
    {
        return $this->hasOne(aparatdesa::class,'masteraparat_id');
    }
}
