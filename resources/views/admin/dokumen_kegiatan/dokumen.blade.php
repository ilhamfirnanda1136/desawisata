@extends('layouts.adminapp')
@section('header')
@stop
@section('content')
<div class="container-fluid" style="margin-top: -10px;">
    <div class="row">
        <div class="col-12 card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Form Dokumen</h3>
                    <button onclick="window.history.back()" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i>
                        Kembali
                    </button>
                </div>
            </div>
            <form action="" method="POST" enctype="multipart/form-data" id="form-dokumen">
            <div class="card-body">
                <div class="row">
                    <input type="hidden" name="kegiatan_id" value="{{ request()->segment(3) }}">
                    <div class="col-sm-12 col-md-6 form-group">
                        <label for="nama_dokumen">Nama Dokumen</label>
                        <input type="text" name="nama_dokumen" id="nama_dokumen" class="form-control">
                        <div class="nama_dokumen"></div>
                    </div>
                    <div class="col-sm1-12 col-md-6 form-group">
                        <label for="filename">Upload File Dokumen</label>
                        <input type="file" name="filename[]" id="filename" class="form-control">
                        <div class="filename"></div>
                    </div>
                    <div id="add-input-file" class="col-12"></div>
                    <div class="col-md-6">
                        <button class="btn btn-info" type="button" id="btn-add-inputfile">
                            <i class="fa fa-plus"></i>
                            Tambah
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </form>
        </div>
        <div class="col-12 card">
            <div class="card-header">
                <h3 class="card-title">Table Dokumen Kegiatan</h3>
            </div>
            <div class="card-body">
                <table id="table" class="table table-striped table-bordered">
                    <thead>
                        <th class="text-center">#</th>
                        <th>Nama Dokumen Kegiatan</th>
                        <th>AKSI</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
@section('footer')
    <script>
        const urlParam = '{{ request()->segment(3) }}'
    </script>
    <script src="{{ asset('js/dokumen_kegiatan/script.js') }}"></script>
@endsection
