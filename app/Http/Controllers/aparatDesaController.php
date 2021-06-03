<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{masteraparat,aparatdesa,wisata};

use DataTables,Validator,Auth;
use Exception;
use Illuminate\Support\Facades\Storage;

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

    public function jsonDT()
    {
        $query = aparatdesa::with(['masteraparat'])->latest('id');
        return DataTables::of($query)->addIndexColumn()
        ->addColumn('action',fn($row) => view('admin.aparat.aparat.action',['model' => $row]))
        ->make(true);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'wisata_id' => 'required',
            'masteraparat_id' => 'required',
            'nama'=> 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'foto' => 'mimes:jpg,png,jpeg'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'message' => 'Masukkan data dengan benar']);
        }
        try {
            $model = new aparatdesa();
            $body = $request->all();
            $body['user_id'] = auth()->user()->id;
            $find = $model->find($body['id']);
            if (!is_null($request->file('foto')) && !is_null($find)) {
                Storage::delete($find->foto);
            }
            if (!is_null($body['id'])) {
                $body['foto'] = !empty($request->file('foto')) ? $request->file('foto')->store('image/foto') : $find->foto;
            }else{
                $body['foto'] = $request->file('foto')->store('image/foto');
            }
            $model->updateOrCreate(['id' => $body['id']],$body);
            $message = !empty($body['id']) ? 'diubah' : 'ditambahkan';
            return response()->json(['success' => $request->all(),'message' => 'Data aparat desa berhasil '.$message]);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }

    }

    public function show($id)
    {
        $row = aparatdesa::with(['wisata','masteraparat'])->find($id);
        return response()->json($row);
    }

    public function destroy(aparatdesa $aparatdesa)
    {
        $aparatdesa->delete();
        return response()->json(['message' => 'Data aparat desa berhasil dihapus']);
    }
}