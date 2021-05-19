<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{masteraparat,aparatdesa,wisata};

use DataTables,Validator,Auth;

class aparatDesaController extends Controller
{
    /* Master Jabatan */
    public function indexMaster()
    {
        return view('admin.aparat.master.jabatan');
    }

    public function tableMaster()
    {
        $model=masteraparat::query();
        return DataTables::of($model)
        ->addColumn('action',function($model){
                return view('admin.aparat.master.action',[
            'model'=>$model,
            'delete' =>route('aparat.master.hapus',$model->id)
            ]);
        })
        ->addIndexColumn()
        ->rawColumns(['action'])
     ->make(true);
    }

    public function hapusMaster($id)
    {
        $jabatan=masteraparat::find($id)->delete();
    	return redirect()->back()->with('sukses','Anda telah menghapus jabatan');
    }

    public function simpanMaster(Request $request)
    {
        $validator=Validator::make($request->all(),['jabatan'=>'required'],['required'=>':attribute tidak boleh kosong']);
        if ($validator->passes()) {
            $jabatan=($request->id=='') ? new masteraparat() : masteraparat::find($request->id);
            $jabatan->jabatan=$request->jabatan;
            $jabatan->save();
           return response()->json(['success'=>$request->all()]);
        }
        return response()->json(['errors'=>$validator->errors()]);
    }

    /* Aparat Desa */

    public function index()
    {
        $desa = wisata::orderBy('nama_desa')->get();
        $jabatan = masteraparat::orderBy('jabatan')->get();
        return view('admin.aparat.aparat.aparat',compact('desa','jabatan'));
    }
}
