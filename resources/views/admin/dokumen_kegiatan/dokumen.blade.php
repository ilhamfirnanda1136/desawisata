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
