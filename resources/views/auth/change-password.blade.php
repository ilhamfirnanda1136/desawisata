@extends('layouts.adminapp')
@section('header')
@stop
@section('content')
<div class="container-fluid" style="margin-top: -10px;">
    <div class="row justify-content-center">
        <div class="col-6 card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Form Ubah Password</h3>
            </div>
            <form action="{{ route('profile.store-password') }}" method="POST">
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
                            <label for="old_password">Password Lama</label>
                            <input type="password" name="old_password" id="old_password" class="form-control @error('old_password') is-invalid @enderror">
                            @error('old_password')
                                <div class="invalid-feedback">
                                    {{ $errors->first('old_password') }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12 form-group">
                            <label for="new_password">Password Baru</label>
                            <input type="password" name="new_password" id="new_password" class="form-control @error('new_password') is-invalid @enderror">
                            @error('new_password')
                                <div class="invalid-feedback">
                                    {{ $errors->first('new_password') }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12 form-group">
                            <label for="password_confirmation">Password Confirmation</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                            @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $errors->first('password_confirmation') }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('footer')
@endsection