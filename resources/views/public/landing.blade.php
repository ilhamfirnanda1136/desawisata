<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('asset/bs5/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/public.css') }}">
</head>
<body>
    {{-- navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light nav-primary fixed-top">
        <div class="container">
          <a class="navbar-brand" href="#"><img src="{{ asset('images/logo-dewi.png') }}" width="110" height="50" class="d-inline-block align-text-top" alt=""></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
              <a class="nav-link active" aria-current="page" href="#peta">Peta</a>
              <a class="nav-link" href="#provinsi">Provinsi</a>
              <a class="nav-link" href="#pendamping">Pendamping</a>
            </div>
          </div>
        </div>
      </nav>
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
                <button class="btn btn-primary">Lihat Lainnya</button>
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
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->nama_pendamping }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">DPD : {{ $item->user->pusat->kd_name }}</h6>
                                <p class="card-text">{{ $item->alamat }}</p>
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
      <footer class="text-center p-3 text-white">
              <div class="d-flex justify-content-center flex-column">
                  <h3>Kawal Dewi</h3>
              </div>
      </footer>
    {{-- end --}}
    <script src="{{ asset('asset/bs5/js/bootstrap.min.js') }}"></script>
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
</body>
</html>