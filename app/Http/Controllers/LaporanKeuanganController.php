<?php

namespace App\Http\Controllers;

use App\Models\LaporanKeuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class LaporanKeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kegiatanId)
    {
        return view('admin.laporan_keuangan.laporan_keuangan', [
            'kegiatan_id' => $kegiatanId,
        ]);
    }

    public function jsonDT($kegiatanId)
    {
        $query = LaporanKeuangan::where('kegiatan_id', $kegiatanId)->latest(
            'id'
        );
        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('tgl', fn($row) => date('d-m-Y', strtotime($row->tgl)))
            ->editColumn(
                'pengeluaran',
                fn($row) => number_format($row->pengeluaran, 0, ' ', '.')
            )
            ->addColumn(
                'action',
                fn($row) => view('admin.laporan_keuangan.action', [
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
        $validator = Validator::make($request->all(), [
            'tgl' => 'required',
            'pengeluaran' => 'required',
            'bukti_pengeluaran' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'Masukkan data dengan benar',
            ]);
        }
        LaporanKeuangan::create([
            'kegiatan_id' => $request->kegiatan_id,
            'tgl' => $request->tgl,
            'keterangan_pembayaran' => $request->keterangan_pembayaran,
            'pengeluaran' => $request->pengeluaran,
            'bukti_pengeluaran' => $request
                ->file('bukti_pengeluaran')
                ->store('image/pengeluaran'),
        ]);
        return response()->json([
            'success' => $request->all(),
            'message' => 'Data laporan keuangan berhasil disimpan',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.laporan_keuangan.detail', [
            'data' => LaporanKeuangan::with('kegiatan')->find($id),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(LaporanKeuangan $laporanKeuangan)
    {
        unlink(
            storage_path('app/public/' . $laporanKeuangan->bukti_pengeluaran)
        );
        $laporanKeuangan->delete();
        return response()->json([
            'message' => 'Data laporan keuangan berhasil dihapus',
        ]);
    }
}
