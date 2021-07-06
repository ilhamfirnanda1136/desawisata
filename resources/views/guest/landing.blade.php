@extends('welcome')
@section('content')
<style>
    .wrap{
        display: flex;
        flex-direction: column;
    }
    .logo-img{
        /* float: right; */
        margin-right: auto;
        margin-left: auto;
        margin-bottom: 1em;
    }
    @media (min-width: 992px) { 
        .logo-img{
            margin-right: 0;
            float: right;
        }
     }
</style>
<div class="jumbotron">
    <div class="d-flex justify-content-center flex-column align-items-center" style="height: 100%;">
        <h2>PROGRAM ASPPI KAWAL DESA WISATA 2021</h2>
    </div>
</div>
<div class="container">
<section id="data" class="mt-4 mb-4">
  <div class="row g-3">
      <div class="col-md-4 col-sm-12">
          <div class="card shadow-sm bg-primary text-white">
              <div class="card-body">
                  <div class="container">
                      <div class="d-flex justify-content-between">
                          <div class="inner">
                              <h5 class="card-title">{{ $count['pendamping'] }}</h5>
                              <p class="card-text">PENDAMPING</p>
                          </div>
                          <div class="icon">
                              <i class="bi bi-people" style="font-size: 4em; opacity:0.5;"></i>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
      </div>
      <div class="col-md-4 col-sm-12">
          <div class="card shadow-sm bg-danger text-white">
              <div class="card-body">
                  <div class="container">
                      <div class="d-flex justify-content-between">
                          <div class="inner">
                              <h5 class="card-title">{{ $count['wisata'] }}</h5>
                              <p class="card-text">DESA WISATA</p>
                          </div>
                          <div class="icon">
                              <i class="bi bi-map" style="font-size: 4em; opacity:0.5;"></i>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
      </div>
      <div class="col-md-4 col-sm-12">
          <div class="card shadow-sm bg-success text-white">
              <div class="card-body">
                  <div class="container">
                      <div class="d-flex justify-content-between">
                          <div class="inner">
                              <h5 class="card-title">{{ $count['project'] }}</h5>
                              <p class="card-text">PROJECT</p>
                          </div>
                          <div class="icon">
                              <i class="bi bi-graph-up" style="font-size: 4em; opacity:0.5;"></i>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
      </div>
  </div>
</section>
<section id="peta">
  <h3 class="text-uppercase text-center text-bold">PETA SEBARAN PENDAMPINGAN ASPPI 2021</h3>
  <div id="map"></div>
</section>
<section id="provinsi" class="mt-3">
  <h3 class="text-uppercase text-center text-bold text-white">Provinsi</h3>
  <div class="row g-3">
      @foreach ($provinsi as $item)
          @php
              $image = !empty($item->image_pusat) ? asset('public/storage/'.$item->image_pusat)  : asset('images/bg-image-kw.jpg');
          @endphp
          <div class="col-md-4 col-sm-12">
              <div class="card shadow-sm">
                  <img src="{{ $image }}" class="card-img-top" alt="...">
                  <div class="card-body">
                      <div class="d-flex justify-content-center flex-column">
                          <h5 class="card-title text-center text-uppercase">{{ $item->kd_name }}</h5>
                          <button class="btn btn-primary ms-auto me-auto detail" data-id="{{ $item->id }}">Selengkapnya</button>
                      </div>
                  </div>
              </div>
          </div>
      @endforeach
  </div>
  <div class="d-flex justify-content-center mt-3">
      <a href="{{ route('landing.provinsi') }}" class="btn btn-primary">Lihat Lainnya</a>
  </div>
</section>
<section id="pendamping">
  <h3 class="text-uppercase text-center text-bold">pendamping</h3>
  <div class="row g-3">
      @foreach ($pendamping as $item)
          <div class="col-sm-12 col-md-4">
              <div class="card shadow">
                  <div class="d-flex justify-content-center p-4">
                      <img src="{{ !empty($item->foto) ? 'https://dpd.asppi.or.id/foto/'.$item->foto : asset('images/person1.png') }}" class="img-rounded" width="100" height="100"  alt="">
                  </div>
                  <div class="card-bod text-center p-3">
                      <h5 class="card-title text-uppercase">{{ $item->nama_pendamping }}</h5>
                      <h6 class="card-subtitle mb-2 text-muted">DPD : {{ $item->user->pusat->kd_name }}</h6>
                  </div>
              </div>
          </div>
      @endforeach
      <div class="d-flex justify-content-center">
          <a href="{{ route('pendamping.detail') }}" class="btn btn-primary">Lihat Lainnya</a>
      </div>
  </div>
</section>
</div>
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
<script>
    const url = "{{ route('wisata') }}"
    const base_url = "{{ url('') }}"
</script>
<script src="{{ asset('js/landing/landing.js') }}"></script>
<script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_2JuavzZQvk6A_c1Kx9B7bRpNOHBS4DY&callback=initMap"
async></script>
@endsection
