<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class apiController extends Controller
{
    public function apiKota(Request $request)
    {
        $kota = \App\Models\kota::where('provinsi_id',$request->provinsi)->orderBy('nama_kota','asc')->get();
        return response()->json(['code'=>200,'data'=>$kota], 200);
    }

    public function apiKecamatan(Request $request)
    {
        $kecamatan = \App\Models\kecamatan::where('kota_id','=',$request->kota)->orderBy('nama_kecamatan','asc')->get();
        return response()->json(['code'=>200,'data'=>$kecamatan], 200);
    }
}
