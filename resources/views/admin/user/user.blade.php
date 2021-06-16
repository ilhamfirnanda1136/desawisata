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
                        <h3 class="card-title">Table Users</h3>
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
                            <th>NAMA</th>
                            <th>USERNAME</th>
                            <th>EMAIL</th>
                            <th>LEVEL</th>
                            <th>PUSAT</th>
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
        <h5 class="modal-title" id="modal-title">Tambah Users</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post" id="form-user" accept-charset="utf-8">
      <div class="modal-body">
          <input type="hidden" name="id" id="id">
          <div class="row">
            <div class="col-12 form-group">
              <label>Nama</label>
              <input type="text" name="name" id="name" class="form-control"/>
              <div class="name"></div>
            </div>
            <div class="col-12 form-group">
              <label>Username</label>
              <input type="text" name="username" id="username" class="form-control"/>
              <div class="username"></div>
            </div>
            <div class="col-12 form-group">
              <label>Email</label>
              <input type="email" name="email" id="email" class="form-control"/>
              <div class="email"></div>
            </div>
            @if (auth()->user()->level == 1)
            <div class="col-12 form-group">
              <label>Pusat</label>
              <select name="pusat_id" id="pusat_id" class="form-control" class="forn-control">
                <option value="" selected disabled>-Pilih-</option>
                @foreach ($pusat as $item)
                    <option value="{{ $item->id }}">{{ $item->kd_name }}</option>
                @endforeach
              </select>
              <div class="pusat_id"></div>
            </div>
            @endif
            <div class="col-12 form-group">
              <label>Level</label>
              <select name="level" id="level" class="form-control" class="forn-control">
                <option value="" selected disabled>-Pilih-</option>
                @if (auth()->user()->level == 1)
                <option value="1">DPP</option>
                @endif
                <option value="2">DPD</option>
                <option value="3">Pendamping</option>
              </select>
              <div class="level"></div>
            </div>
            <div class="col-6 form-group">
              <label>Password</label>
              <input type="password" name="password" id="password" class="form-control">
              <div class="password"></div>
            </div>
            <div class="col-6 form-group">
              <label>Password Confirmation</label>
              <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
              <div class="password_confirmation"></div>
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

<!-- Modal Detail -->
<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalLabelDetail" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabelDetail">Modal Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalBody">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- modal detail end --}}
@stop
@section('footer')
<script src="{{ asset('js/user/script.js') }}"></script>
@endsection