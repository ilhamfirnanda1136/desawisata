<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

use App\Models\{pendamping,User};

use DB,Auth,DataTables,Validator;

class pendampingController extends Controller
{
    public function index()
    {
        $auth = Auth::user()->pusat_id;
        $response = Http::get('https://siska.asppi.or.id/api/member/'.$auth);
        return view('admin.pendamping.pendamping',['member'=>json_decode($response)]);
    }

    public function tablePendamping() 
    {
        $userArray = [];
        if(Auth::user()->pusat_id == 34) {
            $userAuth = User::where('pusat_id','34')->get();
            foreach($userAuth as $u) {
                array_push($userArray,$u->id);
            }
        } else {
            $userAuth = User::where('pusat_id',Auth::user()->pusat_id)->get();
            foreach($userAuth as $u) {
                array_push($userArray,$u->id);
            }
        }
        $model = pendamping::query()->whereIn('user_id',$userArray);
        return DataTables::of($model)
        ->addColumn('action',function($model){
            return view('admin.pendamping.action',[
                'model'=>$model,
            ]);
        })
        ->addColumn('foto_pendamping',function($model){ 
            return $model->getFoto();
        })
        ->addColumn('status_data',function($model){ 
            return $model->getStatus();
        })
        ->addIndexColumn()
        ->rawColumns(['action','foto_pendamping','status_data'])
        ->make(true);

    } 
    
    protected function validator(array $data)
    {
        return Validator::make($data,[
            'nama_pendamping' => 'required'
        ]);
    }

    public function simpanPendamping(Request $request)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()) return response()->json(['errors'=>$validator->errors(),'message'=>'mohon masukkan data dengan benar']);
        $response = Http::get('https://siska.asppi.or.id/api/member/get/'.$request->id_pendamping);
        $member = json_decode($response);
        $data = [
            'user_id' => Auth::user()->id, 'nama_pendamping' => $member->nama,
            'notelp' => $member->telp,'alamat' => $member->almt_rmh, 'id_anggota' => $request->id_pendamping,
            'ktp' => $member->no_ktp,'status' => $request->status,'foto'=> $member->foto
        ];
        pendamping::updateOrCreate(['id'=>$request->id],$data);
        $message = $request->id == '' ? 'anda telah berhasil menambahkan data pendamping' : 'anda telah berhasil mengubah data pendamping ';   
        return response()->json(['success'=>$request->all(),'message'=>$message]); 
    }

    public function hapusPendamping($id)
    {
        $pendamping = pendamping::findOrFail($id);
        $pendamping->delete();
        return response()->json(['message'=>'anda telah berhasil menghapus data pendamping ']);
    }


}
