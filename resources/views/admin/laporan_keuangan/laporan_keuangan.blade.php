@extends('layouts.adminapp')
@section('header')
@stop
@section('content')
    <div class="container-fluid" style="margin-top: -10px;">
        <div class="row">
            <div class="col-12 card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Form Laporan Keuangan</h3>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i>
                            Kembali
                        </a>
                    </div>
                </div>
                <form action="" id="form-laporan-keuangan">
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" name="kegiatan_id" value="{{ request()->segment(3) }}">
                            <div class="col-sm-12 col-md-6 form-group">
                                <label class="tgl">Tanggal Pengeluaran</label>
                                <input type="date" name="tgl" id="tgl" class="form-control"/>
                                <div class="tgl"></div>
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label class="keterangan_pembayaran">Keterang Pembayaran</label>
                                <input type="text" name="keterangan_pembayaran" id="keterangan_pembayaran" class="form-control"/>
                                <div class="pengeluaran"></div>
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label class="pengeluaran">Pengeluaran</label>
                                <input type="text" name="pengeluaran" id="pengeluaran" class="form-control" placeholder="Rp."/>
                                <div class="pengeluaran"></div>
                            </div>
                            <div class="col-md-6 col-sm-12 form-group">
                                <label class="bukti_pengeluaran">Upload Bukti Pengeluaran</label>
                                <input type="file" name="bukti_pengeluaran" id="bukti_pengeluaran" class="form-control"/>
                                <div class="bukti_pengeluaran"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
            <div class="col-12 card">
                <div class="card-header">
                    <h3 class="card-title">Table Laporan Keuangan</h3>
                </div>
                <div class="card-body">
                    <table id="table" class="table table-striped table-bordered">
                        <thead>
                            <th class="text-center">#</th>
                            <th>Tanggal</th>
                            <th>Pengeluaran</th>
                            <th>Bukti Pembayaran</th>
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
        const kegiatanId = '{{ request()->segment(3) }}'
        const url = '{{ url("") }}'
    </script>
    <script src="{{ asset('js/laporan_keuangan/script.js') }}"></script>
@endsection
