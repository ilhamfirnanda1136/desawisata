<?php

namespace App\Http\Controllers;

use App\Models\aparatdesa;
use App\Models\pendamping;
use App\Models\Project;
use App\Models\User;
use App\Models\wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class homeController extends Controller
{
    public function index()
    {
        /* return response()->json(pendamping::count()); */
        $pendamping = [];
        if (Auth::user()->pusat_id == 34) {
            $userAuth = User::where('pusat_id', '34')->get();
            foreach ($userAuth as $u) {
                array_push($pendamping, $u->id);
            }
        } else {
            $userAuth = User::where('pusat_id', Auth::user()->pusat_id)->get();
            foreach ($userAuth as $u) {
                array_push($pendamping, $u->id);
            }
        }
        $data = [
            'pendamping' => pendamping::whereIn(
                'user_id',
                $pendamping
            )->count(),
            'desa_wisata' => wisata::where(
                'pusat_id',
                auth()->user()->pusat_id
            )->count(),
            'users' => User::where(
                'pusat_id',
                auth()->user()->pusat_id
            )->count(),
            'project' => Project::where('user_id', auth()->user()->id)->count(),
            'aparat_desa' => aparatdesa::where(
                'pusat_id',
                auth()->user()->pusat_id
            )->count(),
        ];
        return view('home', $data);
    }
}
