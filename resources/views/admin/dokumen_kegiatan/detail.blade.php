@extends('layouts.adminapp')
@section('header')
@stop
@section('content')
<div class="container-fluid" style="margin-top: -10px;">
    <div class="row">
        <div class="col-12 card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">{{ strtoupper($data->nama_dokumen) }}</h3>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <h5 class="text-center">File Dokumen</h5>
                <div id="file-section">
                    @foreach ($files as $file)
                        @if (pathinfo($file->filename)['extension'] !== 'pdf')
                            <div class="d-flex justify-content-center align-items-center mt-5">
                                <a href="{{ asset('public/storage/'.$file->filename) }}" class="shadow-sm mx-2 p-2"  style="border:1px solid black;" data-toggle="lightbox" data-gallery="gallery">
                                    <img src="{{ asset('public/storage/'.$file->filename) }}" class="img-fluid" width="150" height="150" alt="" >
                                </a>
                            </div>
                            @endif
                    @endforeach
                </div>
                <div class="dokumen-section">
                    <div id="section-pdf" class="row mt-5">
                        <div class="text-center p-2 col-12 mb-3"
                                    style="background: grey; font-weight:bold; color:white; border:1px solid grey; border-radius:10px;">
                                    <i class="fa fa-arrow-down"></i>
                                    Dokumen PDF
                                    <i class="fa fa-arrow-down"></i>
                                </div>
                        <div class="col-12">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama File</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($files as $file)
                                        @if (pathinfo($file->filename)['extension'] === 'pdf')
                                            <tr>
                                                <td>{{ pathinfo($file->filename)['basename'] }}</td>
                                                <td>
                                                    <a href="{{ route('dokumen.prefiew',$file->id)}}" target="_blank" class="btn btn-info">
                                                        <i class="fa fa-eye"></i>
                                                        Preview
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('footer')
<script>
      $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });
  })
</script>
    {{-- <script src="{{ asset('js/kegiatan/script.js') }}"></script> --}}
@endsection
