<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pendamping extends Model
{
    use HasFactory;

    protected $table = 'pendamping';

    protected $fillable = [
        'user_id',
        'id_anggota',
        'pusat_id',
        'nama_pendamping',
        'notelp',
        'alamat',
        'ktp',
        'status',
        'foto',
    ];

    public function getFoto()
    {
        $guest = asset('images/guest.png');
        $image = 'https://dpd.asppi.or.id/foto/' . $this->foto;
        try {
            if (!$this->foto) {
                return "<img src='{$guest}' src='{$this->nama_pendamping}' width='50' />";
            } elseif ($this->foto) {
                return "<img src='{$image}' src='{$this->nama_pendamping}' width='50' />";
            } else {
                return "<img src='{$guest}' src='{$this->nama_pendamping}' width='50' />";
            }
        } catch (Exception $e) {
            return "<img src='{$guest}' src='{$this->nama_pendamping}' width='50' />";
        }
    }

    public function getStatus()
    {
        return $this->status == 1 ? 'Pendamping' : 'Koordinator';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
