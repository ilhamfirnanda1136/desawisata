<?php

namespace App\Http\Controllers;

use App\Models\aparatdesa;
use App\Models\pendamping;
use App\Models\Project;
use App\Models\ProjectType;
use App\Models\User;
use App\Models\wisata;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index()
    {
        /* return response()->json(pendamping::count()); */
        $data = [
            'pendamping' => pendamping::count(),
            'desa_wisata' => wisata::count(),
            'users' => User::count(),
            'project' => Project::count(),
            'aparat_desa' => aparatdesa::count(),
            'jenis_project' => ProjectType::count(),
        ];
        return view('home', $data);
    }
}
