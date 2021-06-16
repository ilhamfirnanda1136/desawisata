@extends('layouts.adminapp')
@section('header')
@stop
    @section('content')
    <div class="container-fluid" style="margin-top: -10px;" id="title-form">
        <div class="row">
            <div class="col-md-12" id="card-tambah">
                <div class="card card-info" >
                    <div class="card-header">
                        <h3 class="card-title" >Form Tambah Wisata</h3>
                    </div>
                    <!-- form start -->
                    <form class="form-horizontal" id="formWisata" method="post" onChange="event.preventDefault()">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="row">
                                @if (auth()->user()->level == 1)
                                <div class="form-group col-12">
                                    <label for="">Pusat</label>
                                    <select name="pusat_id" id="pusat_id" class="form-control" required>
                                        <option value="">--Pusat--</option>
                                        @foreach($pusat as $p)
                                            <option value="{{ $p->id }}">{{ $p->kd_name }}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger pusat_id"></small>
                                </div>
                                @endif
                                <div class="form-group col-md-6">
                                    <label for="nama_desa">Nama Desa</label>
                                    <input type="text" name="nama_desa" class="form-control" id="nama_desa"
                                        placeholder="Masukkan Nama Desa" />
                                    <small class="text-danger nama_desa"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Provinsi</label>
                                    <select name="provinsi_id" id="provinsi_id" class="form-control" required>
                                        <option value="">--Pilih provinsi--</option>
                                        @foreach($provinsi as $p)
                                            <option value="{{ $p->id }}">{{ $p->nama_provinsi }}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger provinsi_id"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Kota/Kabupaten</label>
                                    <select name="kota_id" id="kota_id" class="form-control" required>
                                        <option value="">--Pilih Kota/Kabupaten--</option>
                                    </select>
                                    <small class="text-danger kota_id"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Kecamatan</label>
                                    <select name="kecamatan_id" id="kecamatan_id" class="form-control" required>
                                        <option value="">--Pilih Kecamatan--</option>
                                    </select>
                                    <small class="text-danger kecamatan_id"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Alamat</label>
                                    <textarea name="alamat" id="alamat" class="form-control"
                                        placeholder="Masukkan Alamat Lengkap"></textarea>
                                    <small class="text-danger alamat"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Lat </label>
                                    <input type="text" name="latitude" class="form-control" id="latitude"
                                        placeholder="Masukkan Latitude" />
                                    <small class="text-danger latitude"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Lang</label>
                                    <input type="text" name="langtitude" class="form-control" id="langtitude"
                                        placeholder="Masukkan langtitude" />
                                    <small class="text-danger langtitude"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="date01"><b>Click Peta untuk menentukan
                                            Lokasi Desa Wisata :
                                        </b></label>
                                    <div class="row-fluid sortable" style="text-align:center;">
                                        <div id="map" style="width:100%; height:400px" style="text-align:center;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer" style="margin-top: -31px">
                            <button type="button" id="simpan" class="btn btn-danger col-md-12"><i
                                    class="fa fa-save"></i>
                                    Tambah Desa Wisata</button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-12" id="card-edit" style="display: none">
            <div class="card card-info" >
                <div class="card-header">
                    <h3 class="card-title" >Form Edit Wisata</h3>
                </div>
                <!-- form start -->
                <form class="form-horizontal" id="formWisataEdit" method="post" onChange="event.preventDefault()">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="hidden" name="id" id="edit_id">
                                <label for="nama_desa">Nama Desa</label>
                                <input type="text" name="nama_desa" class="form-control" id="edit_nama_desa"
                                    placeholder="Masukkan Nama Desa" />
                                <small class="text-danger edit_nama_desa"></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Provinsi</label>
                                <select name="provinsi_id" id="edit_provinsi_id" class="form-control" required>
                                    <option value="">--Pilih provinsi--</option>
                                    @foreach($provinsi as $p)
                                        <option value="{{ $p->id }}">{{ $p->nama_provinsi }}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger edit_provinsi_id"></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Kota/Kabupaten</label>
                                <select name="kota_id" id="edit_kota_id" class="form-control" required>
                                    <option value="">--Pilih Kota/Kabupaten--</option>
                                </select>
                                <small class="text-danger edit_kota_id"></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Kecamatan</label>
                                <select name="kecamatan_id" id="edit_kecamatan_id" class="form-control" required>
                                    <option value="">--Pilih Kecamatan--</option>
                                </select>
                                <small class="text-danger edit_kecamatan_id"></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Alamat</label>
                                <textarea name="alamat" id="edit_alamat" class="form-control"
                                    placeholder="Masukkan Alamat Lengkap"></textarea>
                                <small class="text-danger edit_alamat"></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Lat </label>
                                <input type="text" name="latitude" class="form-control" id="edit_latitude"
                                    placeholder="Masukkan Latitude" />
                                <small class="text-danger edit_latitude"></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Lang</label>
                                <input type="text" name="langtitude" class="form-control" id="edit_langtitude"
                                    placeholder="Masukkan langtitude" />
                                <small class="text-danger edit_langtitude"></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label" for="date01"><b>Click Peta untuk menentukan
                                        Lokasi Desa Wisata :
                                    </b></label>
                                <div class="row-fluid sortable" style="text-align:center;">
                                    <div id="map-edit" style="width:100%; height:400px" style="text-align:center;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer" style="margin-top: -31px">
                        <button type="button" id="simpan-edit" class="btn btn-danger col-md-12"><i
                                class="fa fa-save"></i>
                            Edit Desa Wisata</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Data wisata</h3>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table width="100%" id="table-wisata" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Desa Wisata</th>
                                    <th>Wilayah</th>
                                    <th>Alamat</th>
                                    <th>Peta</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Desa Wisata</th>
                                    <th>Wilayah</th>
                                    <th>Alamat</th>
                                    <th>Peta</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="modal-tempat">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lokasi Desa Wisata</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label" for="date01"><b>Peta Lokasi Desa Wisata :
                        </b></label>
                    <div class="row-fluid sortable" style="text-align:center;">
                        <div class="input-group" id="map-view" style="width:100%; height:400px"
                            style="text-align:center;"></div>
                    </div>
                    <div class="pesan"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('footer')
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_2JuavzZQvk6A_c1Kx9B7bRpNOHBS4DY&callback=initMap&libraries=&v=weekly"
    async></script>
<script src="{{ asset('js/wisata/script.js') }}"></script>
@endsection
