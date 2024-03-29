<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{wisata, pendamping, Pusat};

class apiController extends Controller
{
    public function apiKota(Request $request)
    {
        $kota = \App\Models\kota::where('provinsi_id', $request->provinsi)
            ->orderBy('nama_kota', 'asc')
            ->get();
        return response()->json(['code' => 200, 'data' => $kota], 200);
    }

    public function apiKecamatan(Request $request)
    {
        $kecamatan = \App\Models\kecamatan::where(
            'kota_id',
            '=',
            $request->kota
        )
            ->orderBy('nama_kecamatan', 'asc')
            ->get();
        return response()->json(['code' => 200, 'data' => $kecamatan], 200);
    }

    public function apiDesa($pusatid)
    {
        $wisata = wisata::with([
            'kecamatan' => function ($query) {
                $query->with('kota');
            },
            'pusat',
        ])
            ->where('pusat_id', $pusatid)
            ->orderBy('nama_desa', 'asc')
            ->get();
        if ($wisata->count() > 0) {
            return response()->json(['status' => 200, 'wisata' => $wisata]);
        }
        return response()->json(['status' => 404]);
    }

    public function pendampingAll(Request $request)
    {
        if ($request->dpd) {
            $pendamping = pendamping::with('user.pusat')
                ->whereHas('user.pusat', function ($q) use ($request) {
                    return $q->where('id', $request->dpd);
                })
                ->orderBy('nama_pendamping', 'asc')
                ->paginate(6);
        } else {
            $pendamping = pendamping::with('user.pusat')
                ->orderBy('nama_pendamping', 'asc')
                ->paginate(6);
        }
        return response()->json([
            'status' => 200,
            'pendamping' => $pendamping,
        ]);
        // return response()->json(['status' => 404]);
    }

    public function jsonWisata()
    {
        return response(wisata::all());
    }

    public function jsonPusat()
    {
        return response(
            Pusat::with('users.pendampings')
                ->whereHas('users.pendampings')
                ->get()
        );
    }
}
