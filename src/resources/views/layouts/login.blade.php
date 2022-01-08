<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  @include('includes.head')
</head>
<body class=" border-top-wide border-primary d-flex flex-column">
  @yield('content')
</body>
</html>
