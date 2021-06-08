<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kegiatan extends Model
{
    use HasFactory;
    protected $table = 'kegiatan';
    protected $fillable = [
        'project_id',
        'tanggal',
        'nama_kegiatan',
        'keterangan'
    ];

    public function saveActivity($body)
    {
        DB::beginTransaction();
        try {
            $saveKegiatan = self::updateOrCreate(['id' => $body['id']], [
                'project_id' => $body['project_id'],
                'tanggal' => $body['tanggal'],
                'nama_kegiatan' => $body['nama_kegiatan'],
                'keterangan' => $body['keterangan']
            ]);
            $saveDoc = DokumenKegiatan::create([
                'kegiatan_id' => $saveKegiatan->id,
                'nama_dokumen' => $body['nama_dokumen']
            ]);
            DB::table('file_dokumen_kegiatan')->insert([]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
