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

        if (auth()->user()->level == 1) {
            $countUser = User::count();
            $countWisata = wisata::count();
            $countProject = Project::count();
            $countAparat = aparatdesa::count();
        } else {
            $countUser = User::where(
                'pusat_id',
                auth()->user()->pusat_id
            )->count();
            $countWisata = wisata::where(
                'pusat_id',
                auth()->user()->pusat_id
            )->count();
            $countProject = Project::where(
                'user_id',
                auth()->user()->id
            )->count();
            $countAparat = aparatdesa::where(
                'pusat_id',
                auth()->user()->pusat_id
            )->count();
        }
        $data = [
            'pendamping' => pendamping::whereIn(
                'user_id',
                $pendamping
            )->count(),
            'desa_wisata' => $countWisata,
            'users' => $countUser,
            'project' => $countProject,
            'aparat_desa' => $countAparat,
        ];
        return view('home', $data);
    }
}
