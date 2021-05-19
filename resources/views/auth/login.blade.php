<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Login Aplikasi DEWI</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
     <link rel="shortcut icon" href="{{asset('img/favicon.png')}}" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('asset/dist/css/adminlte.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('asset/plugins/iCheck/square/blue.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href=""><img src="{{asset('images/guest.png')}}" width="70"> <br><b>KAWAL DEWI</b></a>
  </div>
  @if(Session::has('successMSG'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Berhasil &nbsp</strong>{{session('successMSG')}}.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif

  @if(Session::has('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error &nbsp</strong>{{session('error')}}.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  @error('username')
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error &nbsp</strong>{{ $message }}.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
   @enderror
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">KAWAL DEWI (KAWAL DESA WISATA) <br>  </p>

      <form action="{{ route('login') }}" method="post">
        <div class="form-group has-feedback">
              @csrf
        <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fa fa-envelope"></i></div>
        </div>
        <input type="username" class="form-control  @error('username') is-invalid @enderror" id="username" placeholder="username" value="{{ old('username') }}" name="username">
         @error('username')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
         @enderror
      </div>
        </div>
        <div class="form-group has-feedback">
          <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fa fa-lock"></i></div>
        </div>
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" name="password">
           @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox"> Ingat Saya
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('asset/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('asset/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('asset/plugins/iCheck/icheck.min.js')}}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass   : 'iradio_square-blue',
      increaseArea : '20%' // optional
    })
  })
</script>
</body>
</html>