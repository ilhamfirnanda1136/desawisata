@extends('layouts.adminapp')
@section('header')
@stop
@section('content')
<div class="container-fluid" style="margin-top: -50px;">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
            </ol>
        </div><!-- /.col -->
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{ $users }}</h3>
                <p>Users</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="{{ route('user.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
          <div class="small-box" style="background-color: #6610f2">
            <div class="inner">
              <h3 class="text-white">{{ $desa_wisata }}</h3>
              <p class="text-white">Peta Desa Wisata</p>
            </div>
            <div class="icon">
              <i class="fa fa-map"></i>
            </div>
            <a href="{{ route('map.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div>
        <div class="col-md-4 col-sm-12">
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $aparat_desa }}</h3>
              <p>Aparat Desa</p>
            </div>
            <div class="icon">
              <i class="fa fa-university"></i>
            </div>
            <a href="{{ route('aparat.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div>
      <div class="col-md-4 col-sm-12">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $pendamping }}</h3>
            <p>Pendamping</p>
          </div>
          <div class="icon">
            <i class="fa fa-users"></i>
          </div>
          <a href="{{ route('pendamping.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
      <div class="col-md-4 col-sm-12">
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{ $desa_wisata }}</h3>
            <p>Desa Wisata</p>
          </div>
          <div class="icon">
            <i class="fa fa-map"></i>
          </div>
          <a href="{{ route('wisata.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-md-4 col-sm-12">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{ $project }}</h3>
            <p>Project</p>
          </div>
          <div class="icon">
            <i class="fa fa-tasks"></i>
          </div>
          <a href="{{ route('project.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('footer')
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_2JuavzZQvk6A_c1Kx9B7bRpNOHBS4DY&callback=initMap&libraries=&v=weekly"
    async></script>
<script>
  async function initMap(){
    const url = "{{ route('wisata.all') }}"
    try {
      const res = await axios(url)
      const data = res.data
      const indonesia = { lat: -4.3602932248789275, lng: 122.38943196612955 }
      const map = new google.maps.Map(document.getElementById('map'), {
        zoom: 3,
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
@endsection
