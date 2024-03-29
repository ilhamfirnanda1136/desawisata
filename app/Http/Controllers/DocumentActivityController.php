<?php

namespace App\Http\Controllers;

use App\Models\DokumenKegiatan;
use App\Models\FileDokumenKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Image;

class DocumentActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kegiatanId)
    {
        return view('admin.dokumen_kegiatan.dokumen', [
            'kegiatan_id' => $kegiatanId,
        ]);
    }

    public function jsonDT($kegiatan_id)
    {
        $query = DokumenKegiatan::where('kegiatan_id', $kegiatan_id)->latest(
            'id'
        );
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json($request->all());
        $validator = Validator::make($request->all(), [
            'nama_dokumen' => 'required',
            'filename' => 'required',
            'filename.*' => 'mimes:jpg,png,jpeg,pdf',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'errors' => $validator->errors(),
                    'message' => 'Masukkan data dengan benar',
                ],
                200
            );
        }
        $body = $request->all();
        $body['doc'] = [];
        /* return response()->json($body); */
        foreach ($request->file('filename') as $file) {
            if ($file->getClientOriginalExtension() === 'pdf') {
                $doc = $file->storeAs(
                    'dokumen/pdf',
                    str_replace(' ', '-', $file->getClientOriginalName())
                );
            } else {
                $img = Image::make($file->getRealPath());
                if ($img->width() > 500) {
                    $path =
                        storage_path() .
                        '/app/public/image/dokumen_img/' .
                        str_replace(' ', '-', $file->getClientOriginalName());
                    $img
                        ->resize(500, $img->height(), function ($const) {
                            $const->aspectRatio();
                        })
                        ->save($path);
                    $doc =
                        'image/dokumen_img/' .
                        str_replace(' ', '-', $file->getClientOriginalName());
                } else {
                    $doc = $file->store('image/dokumen_img');
                }
                // return response()->json(Image::make($file)->width());
            }
            array_push($body['doc'], $doc);
        }
        DB::beginTransaction();
        try {
            $saveDoc = DokumenKegiatan::create([
                'kegiatan_id' => $body['kegiatan_id'],
                'nama_dokumen' => $body['nama_dokumen'],
            ]);
            foreach ($body['doc'] as $file) {
                FileDokumenKegiatan::create([
                    'dokumen_kegiatan_id' => $saveDoc->id,
                    'filename' => $file,
                ]);
            }
            DB::commit();
            return response()->json([
                'success' => $request->all(),
                'message' => 'Data dokumen kegiatan berhasil disimpan',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['errors' => $th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DokumenKegiatan::with('fileDokumenKegiatans')->find($id);
        return view('admin.dokumen_kegiatan.detail', [
            'data' => $data,
            'files' => $data->fileDokumenKegiatans,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rowDocActivity = DokumenKegiatan::with('fileDokumenKegiatans')->find(
            $id
        );
        foreach ($rowDocActivity->fileDokumenKegiatans as $file) {
            unlink(storage_path('app/public/' . $file->filename));
        }
        $rowDocActivity->delete();
        return response()->json([
            'message' => 'Data dokumen kegiatan berhasil dihapus',
        ]);
    }

    public function previewPDF($id)
    {
        $data = FileDokumenKegiatan::find($id);
        return response()->file(public_path('/storage/' . $data->filename));
    }
}
