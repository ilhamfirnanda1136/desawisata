@extends('layouts.adminapp')
@section('header')
@stop
@section('content')
    <div class="container-fluid" style="margin-top: -10px;">
        <div class="row">
            <div class="col-12" id="section-form">
                <div class="card" id="kegiatan-form">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Form Kegiatan Tanggal {{ $tgl_project }}</h3>
                            <button type="button" onclick="window.history.back()" class="btn btn-secondary">
                                <i class="fa fa-arrow-left"></i>
                                Kembali
                            </button>
                        </div>
                    </div>
                    <form action="" method="post" id="form-kegiatan" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" id="id" name="id">
                                <input type="hidden" name="project_id" id="project_id" value="{{ $project_id }}">
                                <div class="form-group col-md-6">
                                    <label for="tanggal">Tanggal Kegiatan</label>
                                    <input type="text" name="tanggal" id="tanggal" class="form-control"
                                        value="{{ $tgl_project }}" readonly>
                                    <div class="tanggal"></div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nama_kegiatan">Nama Kegiatan</label>
                                    <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control">
                                    <div class="nama_kegiatan"></div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="waktu_durasi">Waktu Durasi</label>
                                    <input type="text" name="waktu_durasi" id="waktu_durasi" class="form-control">
                                    <div class="waktu_durasi"></div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lokasi">Lokasi</label>
                                    <input type="text" name="lokasi" id="lokasi" class="form-control">
                                    <div class="lokasi"></div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="jumlah_peserta">Jumlah Peserta</label>
                                    <input type="text" name="jumlah_peserta" id="jumlah_peserta" class="form-control">
                                    <div class="jumlah_peserta"></div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="prosentase_capaian">Prosantase Capaian</label>
                                    <textarea name="prosentase_capaian" id="prosentase_capaian" cols="1" rows="1"
                                        class="form-control"></textarea>
                                    <div class="prosentase_capaian"></div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" cols="5" rows="3"
                                        class="form-control" placeholder="Deskripsi Kegiatan:&#10;Permasalahan:&#10;Solusi:&#10;"></textarea>
                                    <div class="keterangan"></div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Table Kegiatan Periode {{ request()->segment(3) }}</h3>
                            <a href="#section-form" class="btn btn-success">
                                <i class="fa fa-plus"></i>
                                Tambah
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="table" class="table table-striped table-bordered">
                            <thead>
                                <th class="text-center">#</th>
                                <th>Nama Kegiatan</th>
                                <th>Keterangan</th>
                                <th>Prosentas Capaian</th>
                                <th>AKSI</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Modal -->
<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Kegiatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="detail-content">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@stop
@section('footer')
    <script>
        const projectId = '{{ request()->segment(2) }}'
        const dateKegiatan = '{{ request()->segment(3) }}'
    </script>
    <script src="{{ asset('js/kegiatan/script.js') }}"></script>
@endsection
