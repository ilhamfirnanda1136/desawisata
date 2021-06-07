<?php

namespace App\Http\Controllers;

use App\Models\Pusat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.user',[
            'pusat' => Pusat::all()
        ]);
    }

    public function jsonDT()
    {
        $query = User::with('pusat')->latest('id');
        return DataTables::of($query)->addIndexColumn()
        ->addColumn('action',fn($row) => view('admin.user.action',['model' => $row]))
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
        $rules = [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'level' => 'required',
            'pusat_id' => 'required',
        ];
        if (empty($request->id)) {
            $rules['password'] = 'required|confirmed';
            $rules['password_confirmation'] = 'required';
        }else{
            if ($request->has('password')) {
                $rules['password'] = 'confirmed';
                $rules['password_confirmation'] = 'required';
            }
        }
        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'message' => 'Masukkan data user dengan benar']);
        }
        $body = $request->all();
        $body['password'] = Hash::make($request->password);
        User::updateOrCreate(['id' => $request->id],$body);
        $message = !empty($request->id) ? 'diubah' : 'ditambahkan';
        return response()->json(['success' => $request->all(),'message' => 'Data user berhasil '.$message]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(User::with('pusat')->find($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'Data user berhasil dihapus']);
    }
}
