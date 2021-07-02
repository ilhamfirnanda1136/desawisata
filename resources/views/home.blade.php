@extends('layouts.adminapp')
@section('header')
@stop
@section('content')
<div class="container-fluid" style="margin-top: -50px;">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
            </ol>
        </div><!-- /.col -->
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{ $users }}</h3>
                <p>Users</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="{{ route('user.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
          <div class="small-box" style="background-color: #6610f2">
            <div class="inner">
              <h3 class="text-white">{{ $desa_wisata }}</h3>
              <p class="text-white">Peta Sebarang Pendampingan</p>
            </div>
            <div class="icon">
              <i class="fa fa-map"></i>
            </div>
            <a href="{{ route('map.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div>
        <div class="col-md-4 col-sm-12">
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $aparat_desa }}</h3>
              <p>Aparat Desa</p>
            </div>
            <div class="icon">
              <i class="fa fa-university"></i>
            </div>
            <a href="{{ route('aparat.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div>
      <div class="col-md-4 col-sm-12">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $pendamping }}</h3>
            <p>Pendamping</p>
          </div>
          <div class="icon">
            <i class="fa fa-users"></i>
          </div>
          <a href="{{ route('pendamping.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
      <div class="col-md-4 col-sm-12">
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{ $desa_wisata }}</h3>
            <p>Desa Wisata</p>
          </div>
          <div class="icon">
            <i class="fa fa-map"></i>
          </div>
          <a href="{{ route('wisata.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-md-4 col-sm-12">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{ $project }}</h3>
            <p>Project</p>
          </div>
          <div class="icon">
            <i class="fa fa-tasks"></i>
          </div>
          <a href="{{ route('project.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('footer')

@endsection
