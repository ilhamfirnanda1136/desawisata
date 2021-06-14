@extends('layouts.adminapp')
@section('header')
@stop
@section('content')
    <div class="container-fluid" style="margin-top: -10px;">
        <div class="row">
            <div class="col-12" id="section-form">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Form Kegiatan Tanggal {{ $tgl_project }}</h3>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                                <i class="fa fa-arrow-left"></i>
                                Kembali
                            </a>
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
                                <div class="form-group col-md-12">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" cols="5" rows="3"
                                        class="form-control"></textarea>
                                    <div class="keterangan"></div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="prosentase_capaian">Prosantase Capaian</label>
                                    <textarea name="prosentase_capaian" id="prosentase_capaian" cols="5" rows="3"
                                        class="form-control"></textarea>
                                    <div class="prosentase_capaian"></div>
                                </div>
                                <div class="text-center p-2 col-12 mb-3"
                                    style="background: grey; font-weight:bold; color:white; border:1px solid grey; border-radius:10px;">
                                    <i class="fa fa-arrow-down"></i>
                                    Upload Dokumen Kegiatan
                                    <i class="fa fa-arrow-down"></i>
                                </div>
                                <div class="col-12 form-group">
                                    <label for="nama_dokumen">Nama Dokumen</label>
                                    <input type="text" name="nama_dokumen" id="nama_dokumen" class="form-control">
                                    <div class="nama_dokumen"></div>
                                </div>
                                <div class="col-12 form-group">
                                    <label for="filename">Upload File Dokumen</label>
                                    <input type="file" name="filename[]" id="filename" class="form-control">
                                    <div class="filename"></div>
                                </div>
                                <div id="add-input-file" class=" col-12"></div>
                                <div class="col-md-6">
                                    <button class="btn btn-info" type="button" id="btn-add-inputfile">
                                        <i class="fa fa-plus"></i>
                                        Tambah
                                    </button>
                                </div>
                                <div class="text-center p-2 col-12 mb-3 mt-3"
                                    style="background: grey; font-weight:bold; color:white; border:1px solid grey; border-radius:10px;">
                                    <i class="fa fa-arrow-down"></i>
                                    Laporan Keuangan
                                    <i class="fa fa-arrow-down"></i>
                                </div>
                                <div class="col-sm-12 col-md-6 form-group">
                                    <label class="tgl">Tanggal Pengeluaran</label>
                                    <input type="date" name="tgl" id="tgl" class="form-control"/>
                                    <div class="tgl"></div>
                                </div>
                                <div class="col-sm-12 col-md-6 form-group">
                                    <label class="pengeluaran"> Pengeluaran</label>
                                    <input type="text" name="pengeluaran" id="pengeluaran" class="form-control" placeholder="Rp."/>
                                    <div class="pengeluaran"></div>
                                </div>
                                <div class="col-12 form-group">
                                    <label class="bukti_pengeluaran">Upload Bukti Pengeluaran</label>
                                    <input type="file" name="bukti_pengeluaran" id="bukti_pengeluaran" class="form-control"/>
                                    <div class="bukti_pengeluaran"></div>
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
                                <th>AKSI</th>
                            </thead>
                        </table>
                    </div>
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
