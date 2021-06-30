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
    
@endsection
@section('script')
    <script>
        const base_url = "{{ url('') }}"
    </script>
    <script src="{{ asset('js/landing/detail-provinsi.js') }}"></script>
@endsection