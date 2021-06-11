@extends('layouts.adminapp')
@section('header')
@stop
@section('content')
    <div class="container-fluid" style="margin-top: -10px;">
        <div class="row">
            <div class="col-12 card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Laporan Keuangan {{ $data->tgl }}</h3>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i>
                            Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Tanggal</th>
                            <td>:</td>
                            <td>{{ $data->tgl }}</td>
                        </tr>
                        <tr>
                            <th>Nama Kegiatan</th>
                            <td>:</td>
                            <td>{{ $data->kegiatan->nama_kegiatan }}</td>
                        </tr>
                        <tr>
                            <th>Pengeluaran</th>
                            <td>:</td>
                            <td>{{ $data->pengeluaran }}</td>
                        </tr>
                        <tr>
                            <th class="text-center" colspan="3">Bukti Pengeluaran</th>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-center">
                                <img src="{{ asset('public/storage/'.$data->bukti_pengeluaran) }}" alt="">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer')
    {{-- <script src="{{ asset('js/kegiatan/script.js') }}"></script> --}}
@endsection
