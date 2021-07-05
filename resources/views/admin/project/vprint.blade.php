@extends('layouts.adminapp')
@section('header')
@stop
@section('content')
<div class="container-fluid" style="margin-top: -10px;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Buat Laporan</h5>
                </div>
                <form action="{{ route('project.print') }}" method="get" accept-charset="utf-8">
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" name="id" value="{{$id}}">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Mulai</label>
                                    <input id="tgl_start" class="form-control" type="date" name="tgl_start">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Berakhir</label>
                                    <input id="tgl_berakhir" class="form-control" type="date" name="tgl_berakhir">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary float-right">
                            <i class="fa fa-print"></i>
                            Print
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
@section('footer')
@endsection
