<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;

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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // foreach ($request->file('files') as $file) {
        //     $arr[] = $file;
        // }
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
        foreach ($request->file('filename') as $file) {
            if ($file->getClientOriginalExtension() === 'pdf') {
                $file->store('dokumen/pdf');
            } else {
                $img = Image::make($file->getRealPath());
                if ($img->width() > 500) {
                    $img
                        ->resize(500, $img->height(), function ($const) {
                            $const->aspectRatio();
                        })
                        ->save(
                            storage_path() .
                                '/app/image/dokumen_img/' .
                                time() .
                                '.' .
                                $file->extension()
                        );
                } else {
                    $file->store('image/dokumen_img');
                }
                // return response()->json(Image::make($file)->width());
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function show(Kegiatan $kegiatan)
    {
        //
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
        //
    }
}
