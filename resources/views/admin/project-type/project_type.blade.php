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
                        <h3 class="card-title">Table Jenis Proyek</h3>
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
                            <th>Jenis Proyek</th>
                            <th>Action</th>
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
        <h5 class="modal-title" id="modal-title">Tambah Jenis Proyek</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post" id="form-project" accept-charset="utf-8">
      <div class="modal-body">
          <input type="hidden" name="id" id="id">
          <div class="row">
            <div class="col-12 form-group">
              <label>Jenis Proyek</label>
              <input type="text" name="type" id="type" class="form-control"/>
              <div class="type"></div>
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
<script src="{{ asset('js/project-type/index.js') }}"></script>
@endsection
