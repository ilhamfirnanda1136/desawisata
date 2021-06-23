@extends('layouts.adminapp')
@section('header')
@stop
@section('content')
<div class="container-fluid" style="margin-top: -10px;">
    <div class="row">
        <div class="col-md-4 col-lg-4 col-sm-12">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                         src="{{ asset('images/person1.png') }}"
                         alt="User profile picture">
                  </div>
  
                  <h3 class="profile-username text-center">{{ $user->name }}</h3>
                  @php
                    switch($user->level){
                        case '1':
                            $level = 'DPP';
                            break;
                        case '2':
                            $level = 'DPD';
                            break;
                        case '3':
                            $level = 'Pendamping';
                            break;
                        default :
                            $level = 'Tidak ada level';
                            break;
                    }
                  @endphp
                  <p class="text-muted text-center">{{ $level }}</p>
  
                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Username</b> <a class="float-right">{{ $user->username }}</a>
                      </li>
                    <li class="list-group-item">
                      <b>Email</b> <a class="float-right">{{ $user->email }}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Pusat</b> <a class="float-right">{{ $user->pusat->kd_name }}</a>
                    </li>
                  </ul>
  
                  <button id="btn-change" class="btn btn-primary btn-block"><b>Ubah</b></button>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
  
        </div>
        <div class="col-md-8 col-lg-8 col-sm-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Form Profile</h3>
                </div>
                <form action="{{ route('profile.store') }}" method="POST">
                    <div class="card-body">
                        @if(Session::has('message'))
                        <div class="alert alert-success">
                            {{ Session::get('message') }}
                            @php
                                Session::forget('message');
                            @endphp
                        </div>
                        @endif
                        <div class="row">
                            @csrf
                            <div class="col-12 form-group">
                                <label for="name">Nama</label>
                                <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-12 form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" value="{{ $user->username }}" disabled class="form-control">
                            </div>
                            <div class="col-12 form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer"></div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
@section('footer')
<script>
    const btnChange = document.getElementById('btn-change')
    btnChange.addEventListener('click',() => {
        const cardFooter = document.querySelector('.card-footer')
        const btnSubmit = `<button type="submit" class="btn btn-primary float-right">Simpan</button>`
        cardFooter.innerHTML = btnSubmit
    })
</script>
@endsection
