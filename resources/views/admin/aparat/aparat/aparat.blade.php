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
                        <h3 class="card-title">Table Aparat Desa</h3>
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
                            <th>FOTO</th>
                            <th>NAMA</th>
                            <th>JENIS KELAMIN</th>
                            <th>JABATAN</th>
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
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title">Tambah Aparat Desa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post" id="form-aparat" accept-charset="utf-8">
      <div class="modal-body">
          <input type="hidden" name="id" id="id">
          <div class="row">
            <div class="col-12 form-group">
              <label>Foto</label>
              <input type="file" name="foto" id="foto" class="form-control"/>
              <div class="foto"></div>
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>Nama</label>
              <input type="text" name="nama" id="nama" class="form-control"/>
              <div class="nama"></div>
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>Jenis Kelamin</label>
              <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" class="forn-control">
                <option value="" selected disabled>-Pilih-</option>
                <option value="L">Laki-Laki</option>
                <option value="P">Perempuan</option>
              </select>
              <div class="jenis_kelamin"></div>
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>Email</label>
              <input type="text" name="email" id="email" class="form-control"/>
              <div class="email"></div>
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>No Telepon</label>
              <input type="text" name="notelp" id="notelp" class="form-control"/>
              <div class="notelp"></div>
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>Jenis Proyek</label>
              <select name="masteraparat_id" id="masteraparat_id" class="form-control select2">
                <option value="" selected disabled>-Pilih-</option>
                @foreach ($jabatan as $item)
                    <option value="{{ $item->id }}">{{ $item->jabatan }}</option>
                @endforeach
              </select>
              <div class="type_project_id"></div>
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>Wisata</label>
              <select name="wisata_id" id="wisata_id" class="form-control">
                  <option value="">-Pilih-</option>
                  @foreach ($desa as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_desa }}</option>
                  @endforeach
              </select>
              <div class="wisata_id"></div>
            </div>
            <div class="col-12 form-group">
              <label>Alamat</label>
              <textarea name="alamat" id="alamat" class="form-control" cols="5" rows="3"></textarea>
              <div class="alamat"></div>
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
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_2JuavzZQvk6A_c1Kx9B7bRpNOHBS4DY&callback=initMap&libraries=&v=weekly"
    async></script>
<script src="{{ asset('js/aparat/script.js') }}"></script>
@endsection