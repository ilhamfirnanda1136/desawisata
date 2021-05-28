<?php

namespace App\Http\Controllers;

use App\Models\ProjectType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\ProjectFactory;
use Yajra\DataTables\Facades\DataTables;

class ProjectTypeController extends Controller
{
    public function index()
    {
        return view('admin.project-type.project_type');
    }

    public function jsonDT()
    {
        $query = ProjectType::latest('id');
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action',fn($row) => view('admin.project-type.action',['model' => $row]))
            ->make(true);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'type' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'message' => 'Masukkan data dengan benar']);
        }
        try {
            ProjectType::updateOrCreate(['id' => $request->id],$request->all());
            $message = !empty($request->id) ? 'diubah' : 'ditambahkan'; 
            return response()->json(['success' => $request->all(),'message' => 'Data tipe project berhasil '. $message]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Internal Server Error', 'error' => $e->getMessage()]);
        }
    }

    public function show(ProjectType $projectType)
    {
        try {
            return response()->json($projectType);
        } catch (Exception $e) {
            return response()->json(['message' => 'Internal Server Error', 'error' => $e->getMessage()]);
        }
    }

    public function destroy(ProjectType $projectType)
    {
        try {
            $projectType->delete();
            return response()->json(['message' => 'Data berhasil dihapus']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Internal Server Error', 'error' => $e->getMessage()]);
        }
    }
}
