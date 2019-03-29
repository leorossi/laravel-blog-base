<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mini Blog - @yield('title') </title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>

@include('layouts._navbar')

<!-- Page Content -->
<div class="container mt-3">
    @yield('content')
</div>

<!-- Bootstrap core JavaScript -->
<script src="{{ asset('js/app.js') }}"></script>

</body>

</html>
