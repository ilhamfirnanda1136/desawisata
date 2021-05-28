@extends('layouts.adminapp')
@section('header')
@stop
@section('content')
<div class="container-fluid" style="margin-top: -10px;">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Table Proyek</h3>
                        <button class="btn btn-success" id="btn-modal">
                            <i class="fa fa-plus"></i>
                            Tambah
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="table" class="table table-striped table-bordered">
                        <thead>
                            <th class="text-center">#</th>
                            <th>TAHUN PROYEK</th>
                            <th>NAMA PROYEK</th>
                            <th>JENIS PROYEK</th>
                            <th>NILAI PAGU PROYEK</th>
                            <th>TANGGAL MULAI/BERAKHIR</th>
                            <th>AKSI</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- modal --}}
<div class="modal fade" id="my-modal" tabindex="-1" role="dialog" aria-labelledby="my-modal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title">Tambah Proyek</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post" id="form-project" accept-charset="utf-8">
      <div class="modal-body">
          <input type="hidden" name="id" id="id">
          <div class="row">
            <div class="col-12 form-group">
              <label>Tahun Proyek</label>
              <input type="text" name="tahun_project" id="tahun_project" class="form-control"/>
              <div class="tahun_project"></div>
            </div>
            <div class="col-12 form-group">
              <label>Nama Proyek</label>
              <input type="text" name="nama_project" id="nama_project" class="form-control"/>
              <div class="nama_project"></div>
            </div>
            <div class="col-12 form-group">
              <label>Jenis Proyek</label>
              <select name="type_project_id" id="type_project_id" class="form-control select2">
                <option value="" selected disabled>-Pilih-</option>
                @foreach ($project_types as $item)
                  <option value="{{ $item->id }}">{{ $item->type }}</option>
                @endforeach
              </select>
              <div class="type_project_id"></div>
            </div>
            <div class="col-12 form-group">
              <label>Nilai Pugu Proyek</label>
              <input type="text" name="nilai_pagu_project" id="nilai_pagu_project" class="form-control"/>
              <div class="nilai_pagu_project"></div>
            </div>
            <div class="col-6 form-group">
              <label>Tanggal Mulai</label>
              <input type="date" name="tgl_start" id="tgl_start" class="form-control"/>
              <div class="tgl_start"></div>
            </div>
            <div class="col-6 form-group">
              <label>Tanggal Berakhir</label>
              <input type="date" name="tgl_finish" id="tgl_finish" class="form-control"/>
              <div class="tgl_finish"></div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
{{-- modal end --}}
@stop
@section('footer')
<script src="{{ asset('js/project/index.js') }}"></script>
@endsection
