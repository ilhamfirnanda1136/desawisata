<?php

namespace App\Http\Controllers;

use App\Models\DokumenKegiatan;
use App\Models\FileDokumenKegiatan;
use App\Models\Kegiatan;
use App\Models\LaporanKeuangan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        return view('admin.kegiatan.kegiatan', [
            'project_id' => $id,
            'tgl_project' => $date,
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
            'nama_dokumen' => 'required',
            'prosentase_capaian' => 'required',
            'tgl' => 'required',
            'pengeluaran' => 'required',
            'bukti_pengeluaran' => 'required|mimes:jpg,png,jpeg',
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
                [
                    'project_id' => $body['project_id'],
                    'tanggal' => $body['tanggal'],
                    'nama_kegiatan' => $body['nama_kegiatan'],
                    'keterangan' => $body['keterangan'],
                    'prosentase_capaian' => $body['prosentase_capaian'],
                ]
            );
            $message = !empty($body['id']) ? 'diubah' : 'ditambahkan';
            return response()->json([
                'success' => $request->all(),
                'message' => 'Data kegiatan berhasil ' . $message,
            ]);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
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
        $rowDocActivity = DokumenKegiatan::with('fileDokumenKegiatans')
            ->where('kegiatan_id', $kegiatan->id)
            ->first();
        foreach ($rowDocActivity->fileDokumenKegiatans as $file) {
            Storage::delete($file->filename);
        }
        $kegiatan->delete();

        return response()->json(['messge' => 'Data kegiatan berhasil dihapus']);
    }

    public function indexDocumentActivity()
    {
        return view('admin.dokumen_kegiatan.dokumen');
    }

    public function jsonDocumentActivity()
    {
        $query = DokumenKegiatan::latest('id');
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn(
                'action',
                fn($row) => view('admin.dokumen_kegiatan.action', [
                    'model' => $row,
                ])
            )
            ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DokumenKegiatan::with(['fileDokumenKegiatans'])
            ->where('kegiatan_id', $id)
            ->first();
        // dd($data);
        // return response()->json($data);
        return view('admin.dokumen_kegiatan.detail', [
            'data' => $data,
            'files' => $data->fileDokumenKegiatans,
        ]);
    }

    /**
     * Show detail financial statement.
     *
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function showFinancialStatement($project_id)
    {
        return view('admin.laporan_keuangan.laporan_keuangan', [
            'data' => LaporanKeuangan::with('kegiatan')
                ->where('kegiatan_id', $project_id)
                ->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        //
    }
}
