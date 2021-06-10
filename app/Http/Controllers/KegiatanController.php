<?php

namespace App\Http\Controllers;

use App\Models\DokumenKegiatan;
use App\Models\FileDokumenKegiatan;
use App\Models\Kegiatan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Image;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexDokumenKegiatan($id)
    {
        return response()->json('ok');
        return view('admin.kegiatan.dokumen', [
            'data' => DokumenKegiatan::with('fileDokumenKegiatan')
                ->where('kegiatan_id', $id)
                ->first(),
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
            'filename' => 'required',
            'filename.*' => 'mimes:jpg,png,jpeg,pdf',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'Masukkan data kegiatan dengan benar',
            ]);
        }
        $body = $request->all();
        $body['doc'] = [];
        foreach ($request->file('filename') as $file) {
            if ($file->getClientOriginalExtension() === 'pdf') {
                $doc = $file->storeAs(
                    'dokumen/pdf',
                    $file->getClientOriginalName()
                );
            } else {
                $img = Image::make($file->getRealPath());
                if ($img->width() > 500) {
                    $path =
                        storage_path() .
                        '/app/public/image/dokumen_img/' .
                        time() .
                        '.' .
                        $file->extension();
                    $img
                        ->resize(500, $img->height(), function ($const) {
                            $const->aspectRatio();
                        })
                        ->save($path);
                    $doc = $img;
                } else {
                    $doc = $file->store('image/dokumen_img');
                }
                // return response()->json(Image::make($file)->width());
            }
            array_push($body['doc'], $doc);
        }
        DB::beginTransaction();
        try {
            $saveKegiatan = Kegiatan::updateOrCreate(
                ['id' => $body['id']],
                [
                    'project_id' => $body['project_id'],
                    'tanggal' => $body['tanggal'],
                    'nama_kegiatan' => $body['nama_kegiatan'],
                    'keterangan' => $body['keterangan'],
                ]
            );
            $saveDoc = DokumenKegiatan::create([
                'kegiatan_id' => $saveKegiatan->id,
                'nama_dokumen' => $body['nama_dokumen'],
            ]);
            foreach ($body['doc'] as $file) {
                FileDokumenKegiatan::create([
                    'dokumen_kegiatan_id' => $saveDoc->id,
                    'filename' => $file,
                ]);
            }
            DB::commit();
            $message = !empty($body['id']) ? 'diubah' : 'ditambahkan';
            return response()->json([
                'success' => $request->all(),
                'message' => 'Data kegiatan berhasil ' . $message,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage());
        }
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
        return view('admin.kegiatan.dokumen', [
            'data' => $data,
            'files' => $data->fileDokumenKegiatans,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kegiatan $kegiatan)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();
        return response()->json(['messge' => 'Data kegiatan berhasil dihapus']);
    }
}
