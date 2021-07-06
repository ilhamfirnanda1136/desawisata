<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Project;
use App\Models\ProjectType;
use App\Models\wisata;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class ProjectController extends Controller
{
    public function index()
    {
        return view('admin.project.project', [
            'project_types' => ProjectType::all(),
            'wisata' => wisata::where('pusat_id',auth()->user()->pusat_id)->get()
        ]);
    }

    public function viewBoardControl(Project $project)
    {
        // return response()->json($project);
        // dd(Kegiatan::with('dokumenKegiatans')->first()->dokumenKegiatans);
        return view('admin.project.board-control', [
            'data' => $project,
            'kegiatan' => new Kegiatan(),
        ]);
    }

    public function jsonDT()
    {
        $query = Project::with('projectType')->where('user_id',auth()->user()->id)->latest('id');
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn(
                'tanggal',
                fn($row) => date('d-m-Y', strtotime($row->tgl_start)) .
                    '/' .
                    date('d-m-Y', strtotime($row->tgl_finish))
            )
            ->editColumn(
                'nilai_pagu_project',
                fn($row) => number_format($row->nilai_pagu_project, 0, ' ', '.')
            )
            ->addColumn(
                'action',
                fn($row) => view('admin.project.action', ['model' => $row])
            )
            ->rawColumns(['tanggal'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type_project_id' => 'required',
            'tahun_project' => 'required',
            'nama_project' => 'required',
            'nilai_pagu_project' => 'required',
            'tgl_start' => 'required',
            'tgl_finish' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'Masukkan data project dengan benar',
            ]);
        }
        try {
            $body = $request->all();
            $body['user_id'] = auth()->user()->id;
            Project::updateOrCreate(['id' => $body['id']], $body);
            $message = !empty($body['id']) ? 'diubah' : 'ditambahkan';
            return response()->json([
                'success' => $request->all(),
                'message' => 'Data project berhasil ' . $message,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Internal Server Error',
            ]);
        }
    }

    public function show(Project $project)
    {
        try {
            return response()->json($project);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Internal Server Error',
            ]);
        }
    }

    public function destroy(Project $project)
    {
        try {
            $project->delete();
            return response()->json([
                'message' => 'Data project berhasil dihapus',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Internal Server Error',
            ]);
        }
    }

    public function viewPrint($id)
    {
        return view('admin.project.vprint',[
            'id' => $id
        ]);
    }

    public function print(Request $request)
    {
        $formatDate = fn($tgl) => date('d-m-Y',strtotime($tgl));
        $query = Project::with(['kegiatans' => fn($q) => $q->whereBetween('tanggal',[$formatDate($request->tgl_start),$formatDate($request->tgl_berakhir)]),'wisata'])->where('id',$request->id)->first();
        /* return response($query); */
        return PDF::loadView('admin.project.print',[
            'project' => $query
        ])->setPaper('A4','potrait')->stream();
    }
}
