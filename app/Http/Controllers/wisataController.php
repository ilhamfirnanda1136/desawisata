<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{wisata, User, provinsi, kota, kecamatan, Pusat};

use DB, Auth, DataTables, Validator;

class wisataController extends Controller
{
    public function index()
    {
        $provinsi = provinsi::orderBy('nama_provinsi')->get();
        $pusat = Pusat::all();
        return view('admin.wisata.wisata', compact('provinsi', 'pusat'));
    }

    public function wisataAll()
    {
        return response()->json(
            auth()->user()->level == 1
                ? wisata::all()
                : wisata::where('pusat_id', auth()->user()->pusat_id)->get()
        );
    }

    public function tableWisata()
    {
        $model =
            auth()->user()->level == 1
                ? wisata::query()->orderBy('nama_desa')
                : wisata::query()
                    ->where('pusat_id', Auth::user()->pusat_id)
                    ->orderBy('nama_desa');
        return DataTables::of($model)
            ->addColumn('action', function ($model) {
                return view('admin.wisata.action', [
                    'model' => $model,
                ]);
            })
            ->addColumn('marker', function ($model) {
                return " <button class='btn btn-success btn-md btn-peta' data-lat='{$model->latitude}' data-lang='{$model->langtitude}'><i class='fa fa-map-marker'></i></button>";
            })
            ->addColumn('wilayah', function ($model) {
                return "Provinsi : {$model->kecamatan->kota->provinsi->nama_provinsi} <br> Kabupaten/Kota : {$model->kecamatan->kota->nama_kota} <br> Kecamatan : {$model->kecamatan->nama_kecamatan}";
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'marker', 'wilayah'])
            ->make(true);
    }

    public function ambilWisata($id)
    {
        $wisata = wisata::with([
            'kecamatan' => function ($query) {
                $query->with('kota', function ($query) {
                    $query->with('provinsi');
                });
            },
        ])
            ->where('id', $id)
            ->first();
        $kota = kota::where(
            'provinsi_id',
            $wisata->kecamatan->kota->provinsi->id
        )
            ->orderBy('nama_kota', 'asc')
            ->get();
        $kecamatan = kecamatan::where('kota_id', $wisata->kecamatan->kota->id)
            ->orderBy('nama_kecamatan', 'asc')
            ->get();
        return response()->json([
            'wisatas' => $wisata,
            'kota' => $kota,
            'kecamatan' => $kecamatan,
        ]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'provinsi_id' => 'required',
            'kota_id' => 'required',
            'kecamatan_id' => 'required',
            'nama_desa' => 'required',
            'alamat' => 'required',
            'latitude' => 'required',
            'langtitude' => 'required',
        ]);
    }

    public function simpanWisata(Request $request)
    {
        // return response($request->all());
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'mohon masukkan data dengan benar',
            ]);
        }
        $pusatId =
            auth()->user()->level == 1
                ? $request->pusat_id
                : auth()->user()->pusat_id;
        wisata::updateOrCreate(
            ['id' => $request->id],
            array_merge($request->all(), ['pusat_id' => $pusatId])
        );
        $message =
            $request->id == ''
                ? 'anda telah berhasil menambahkan data desa wisata'
                : 'anda telah berhasil mengubah data desa wisata ';
        return response()->json([
            'success' => $request->all(),
            'message' => $message,
        ]);
    }

    public function hapusWisata($id)
    {
        $wisata = wisata::findOrFail($id);
        $wisata->delete();
        return response()->json([
            'message' => 'anda telah berhasil menghapus data Desa Wisata ',
        ]);
    }
}
