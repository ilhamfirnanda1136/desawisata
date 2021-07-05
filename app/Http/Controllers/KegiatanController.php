<?php

namespace App\Http\Controllers;

use App\Models\DokumenKegiatan;
use App\Models\FileDokumenKegiatan;
use App\Models\Kegiatan;
use App\Models\LaporanKeuangan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $date)
    {
        $data = Kegiatan::with(['dokumenKegiatans', 'laporanKeuangans'])
            ->where('project_id', $id)
            ->where('tanggal', $date)
            ->get();
        if (!empty($data)) {
            $color = 'yellow';
        } elseif (!empty($data->dokumenKegiatans)) {
            $color = 'orange';
        } elseif (
            !empty($data->dokumenKegiatans) &&
            !empty($data->laporanKeuangans)
        ) {
            $color = 'green';
        }
        return view('admin.kegiatan.kegiatan', [
            'project_id' => $id,
            'tgl_project' => $date,
            'color' => $color,
        ]);
    }

    public function jsonDT($project_id, $date)
    {
        $query = Kegiatan::where('project_id', $project_id)
            ->where('tanggal', $date)
            ->latest('id');
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn(
                'action',
                fn($row) => view('admin.kegiatan.action', ['model' => $row])
            )
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json(request()->file('filename'));
        $validator = Validator::make($request->all(), [
            'nama_kegiatan' => 'required',
            'keterangan' => 'required',
            'prosentase_capaian' => 'required',
            'lokasi' => 'required',
            'waktu_durasi' => 'required',
            'jumlah_peserta' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'Masukkan data kegiatan dengan benar',
            ]);
        }
        $body = $request->all();
        try {
            Kegiatan::updateOrCreate(
                ['id' => $body['id']],
                $body
            );
            $message = !empty($body['id']) ? 'diubah' : 'ditambahkan';
            return response()->json([
                'success' => $request->all(),
                'message' => 'Data kegiatan berhasil ' . $message,
            ]);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kegiatan $kegiatan)
    {
        $row = $kegiatan
            ->with([
                'dokumenKegiatans.fileDokumenKegiatans',
                'laporanKeuangans',
            ])
            ->find($kegiatan->id);
        // return response($row);
        foreach ($row->dokumenKegiatans as $doc) {
            foreach ($doc->fileDokumenKegiatans as $file) {
                unlink(storage_path('app/public/' . $file->filename));
            }
        }
        foreach ($row->laporanKeuangans as $lk) {
            unlink(storage_path('app/public/' . $lk->bukti_pengeluaran));
        }
        $kegiatan->delete();

        return response()->json(['messge' => 'Data kegiatan berhasil dihapus']);
    }
}
