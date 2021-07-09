@extends('welcome')
@section('content')
<section id="detail-provinsi">
    <div class="header bg-primary p-2 mb-3 rounded-2 shadow">
        <div class="d-flex justify-content-between">
            <h3 class="text-white">Semua Pendamping</h3>
            <div class="right-side d-flex justify-content-between">
                <div class="input-group me-3 select-filter hidden" style="width: 20em;">
                    <select name="pusat_id" id="pusat_id" aria-describedby="button-addon2" class="form-control">
                        <option value="">-Pilih DPD-</option>
                        @foreach ($pusat as $item)
                            <option value="{{ $item->id }}">{{ $item->kd_name }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-danger" type="button" id="button-addon2">
                        <i class="bi bi-x-circle-fill"></i>
                    </button>
                  </div>
                <button class="btn btn-warning me-2" id="filter">
                    <i class="bi bi-funnel"></i>
                    Filter DPD
                </button>
                <a href="{{ route('guest') }}" class="btn btn-success">
                    <i class="bi bi-arrow-left-circle"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>
    <div class="row g-2 mb-3"></div>
    <div id="paginate"></div>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
          <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="firstPage()">First</a></li>
          <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="lastPage()">Last</a></li>
        </ul>
    </nav>
</section>
<div class="modal fade" id="my-modal" tabindex="-1">
    <div class="modal-dialog modal-lg">
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
    <script>
        const base_url = "{{ url('') }}"
    </script>
    <script src="{{ asset('js/landing/detail-pendamping.js') }}"></script>
@endsection