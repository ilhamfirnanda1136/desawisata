<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kawal Dewi</title>
      <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="{{asset('img/favicon.png')}}" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/asset/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link href="{{asset('lte/preloader.css')}}" rel="stylesheet">
  <!-- DataTables -->

  <link rel="stylesheet" href="{{asset('asset/plugins/datatables/dataTables.bootstrap4.css')}}">
  <link rel="stylesheet" href="{{asset('asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <link rel="stylesheet" type="text/css" href="{{asset('asset/plugins/bootstrap/css/bootstrap-datetimepicker.css')}}">
  <link rel="stylesheet" href="{{asset('asset/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
   <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{asset('asset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
   <link rel="stylesheet" type="text/css" href="https://teras.kejati-sulsel.go.id/css/responsive.css">
   <style>
   .user-panel img{
     width: 4.1rem !important;
     height: 50px;
   }
    .modal-body ul li {
     font-weight:bold !important;
   }
   .modal-body ul li span {
     font-weight:300 !important;
   }
   </style>
  @yield('header')
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

@include('layouts.include.header_admin')

@include('layouts.include.sidebar_admin')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"></a></li>
              <li class="breadcrumb-item active"></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

  @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">

    <strong>Kawal DEWI Copyright © {{date('Y')}}</strong>
  </footer>

   <!--Loading Bar-->
   <div class="div-loading">
    <div class="lds-dual-ring" style="display: none;"></div>
  </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('asset/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('asset/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{asset('asset/plugins/overlayScrollbars/js/jquery.overlayScrollbars.js')}}"></script>
<script src="{{asset('asset/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('asset/dist/js/demo.js')}}"></script>
<script src="{{asset('asset/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('asset/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{asset('asset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script type="text/javascript" src="{{asset('asset/plugins/bootstrap/js/bootstrap-datetimepicker.js')}}"></script>
<!-- overlayScrollbars -->
<script type="text/javascript" src="https://teras.kejati-sulsel.go.id/js/dataTables_002.js"></script>
<script src="{{asset('js/input.js')}}"></script>
<script type="text/javascript">
 const process_env_url = "{{ url('') }}";
      @if(Session::has('sukses'))
      toastr.success("{{Session::get('sukses')}}", "sukses");
       swal({
              title: "Pesan!",
              text: "{{Session::get('sukses')}}",
              icon: "success",
          });
      @endif
      $(function() {
    //The passed argument has to be at least a empty object or a object with your desired options
    $('.sidebar').overlayScrollbars({ });
});
</script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
@yield('footer')
</body>
</html>
