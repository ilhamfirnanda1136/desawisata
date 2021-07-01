<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.fe.header')
</head>
<body>
    @if (Request::url() === url('').'/guest')
    @include('layouts.fe.navbar')
    @endif
    @yield('content')
    @include('layouts.fe.footer')
    <script src="{{ asset('asset/bs5/js/bootstrap.min.js') }}"></script>
    <script src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script>
    @yield('script')
</body>
</html>