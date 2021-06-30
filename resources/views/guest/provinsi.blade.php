@extends('welcome')
@section('content')
<section id="detail-provinsi">
    <h3 class="text-center mb-3">Semua Provinsi</h3>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        Table Provinsi
                    </h5>
                </div>
                <div class="card-body">
                    <div id="table"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="my-modal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">List Desa Wisata</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div id="modal-table"></div>
        </div>
      </div>
    </div>
  </div>
  
    
@endsection
@section('script')
    <script src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script>
    <script>
        const base_url = "{{ url('') }}"
    </script>
    <script src="{{ asset('js/landing/detail-provinsi.js') }}"></script>
@endsection