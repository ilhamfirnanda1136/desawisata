<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.fe.header')
</head>
<body>
    @include('layouts.fe.navbar')
    @yield('content')
    @include('layouts.fe.footer')
    <script src="{{ asset('asset/bs5/js/bootstrap.min.js') }}"></script>
    @yield('script')
</body>
</html>