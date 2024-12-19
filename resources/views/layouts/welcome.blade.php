<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Attendance Management System</title>
    <link href="{{ URL::asset('assets/css/attendanceFront.css') }}" rel="stylesheet" type="text/css" />
    @include('layouts.link')
</head>
<body class="pb-0" style="background: #2a3142;">
    @yield('content')
    @include('layouts.footer-script')
    @include('includes.flash')
    <script src="{{ URL::asset('assets/js/attendanceFront.js') }}"></script>
</body>
</html>
