@extends('layouts.adminapp')
@section('header')
@stop
@section('content')
<div class="container-fluid" style="margin-top: -10px;">
    <div class="row">
        <div class="col-12 card">
            <div class="card-header">
                <h3 class="card-title">Peta Desa Wisata</h3>
            </div>
            <div class="card-body">
                <div id="map" style="width:100%; height:400px"></div>
            </div>
        </div>
    </div>
</div>
@stop
@section('footer')
<script>
    const url = "{{ route('wisata.all') }}"
</script>
<script src="{{ asset('js/map/script.js') }}"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_2JuavzZQvk6A_c1Kx9B7bRpNOHBS4DY&callback=initMap"
    async></script>
@endsection