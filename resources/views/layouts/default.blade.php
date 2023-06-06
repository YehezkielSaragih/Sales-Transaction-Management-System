<!DOCTYPE html>

<html lang="en">

<head>
    @include('includes.head')
</head>

<body>
    @include('includes.navbar')
    @yield('content')
    @yield('script')
</body>

</html>