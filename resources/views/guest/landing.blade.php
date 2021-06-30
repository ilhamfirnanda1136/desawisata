@extends('welcome')
@section('content')
<div class="jumbotron d-flex justify-content-center align-items-center">
    <h2>PROGRAM ASPPI KAWAL DESA WISATA 2021</h2>
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
  <h3 class="text-uppercase text-center text-bold">peta</h3>
  <div id="map"></div>
</section>
<section id="provinsi" class="mt-3">
  <h3 class="text-uppercase text-center text-bold text-white">Provinsi</h3>
  <div class="row g-3">
      @foreach ($provinsi as $item)
          <div class="col-md-4 col-sm-12">
              <div class="card shadow-sm">
                  <img src="{{ asset('images/bg-image-kw.jpg') }}" class="card-img-top" alt="...">
                  <div class="card-body">
                      <div class="d-flex justify-content-center flex-column">
                          <h5 class="card-title text-center text-uppercase">{{ $item->kd_name }}</h5>
                          <a href="#" class="btn btn-primary ms-auto me-auto">Selengkapnya</a>
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
                      <h5 class="card-title">{{ $item->nama_pendamping }}</h5>
                      <h6 class="card-subtitle mb-2 text-muted">DPD : {{ $item->user->pusat->kd_name }}</h6>
                  </div>
              </div>
          </div>
      @endforeach
      <div class="d-flex justify-content-center">
          <button class="btn btn-primary">Lihat Lainnya</button>
      </div>
  </div>
</section>
</div>
@endsection
@section('script')
<script>
    const url = "{{ route('wisata') }}"
    async function initMap() {
        try {
            const res = await fetch(url)
            const data = await res.json()
            const indonesia = { lat: -4.3602932248789275, lng: 122.38943196612955 }
            const map = new google.maps.Map(document.getElementById('map'), {
            zoom: 5,
            center: indonesia,
            })
            data.forEach((item) => {
            const marker = new google.maps.Marker({
                position: {
                lat: parseFloat(item.latitude),
                lng: parseFloat(item.langtitude),
                },
                map: map,
            })
            const infoWindow = new google.maps.InfoWindow({
                content: `
        <p>
            <i class="fa fa-home"></i>
            <b>Desa : ${item.nama_desa.toUpperCase()}</b>
        <p>
            <i class="fa fa-home"></i>
            <b>Alamat : ${item.alamat}</b>
        </p>
        `,
            })
            marker.addListener('click', () => {
                infoWindow.open(map, marker)
            })
            })
        } catch (error) {
            console.error(error)
        }
    }
</script>
<script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_2JuavzZQvk6A_c1Kx9B7bRpNOHBS4DY&callback=initMap"
async></script>
@endsection
