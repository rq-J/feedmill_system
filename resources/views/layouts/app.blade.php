<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="justine">

    <link rel="icon" type="image/png" href="../assets/img/icons/bgc.png">
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <script src="{{ asset('assets/css/fontawesome.css') }}"></script>
    {{-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script> --}}

    {{-- Styles --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link id="pagestyle" href="../assets/css/bootstrap.css" rel="stylesheet" />
    @yield('styles')
    @livewireStyles

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    @yield('scripts')
</head>

<body class="font-sans antialiased g-sidenav-show  bg-gray-100">
    {{-- @yield('content') --}}
    @livewireScripts

    @include('layouts.navbars.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        @include('layouts.navbars.nav')
        <div class="container-fluid py-4">
            @yield('content')
            @include('layouts.footers.footer')
        </div>
    </main>
</body>

<script>
    $.ajax({
        type: "GET",
        url: "{{ config('app.root_domain') . config('app.user_details_slug') . \Crypt::encryptString(Auth::user()->id) }}",
        dataType: 'json',
        success: function(response) {
            document.getElementById('fullname').innerHTML = response['first_name'] + " " + response[
                'last_name'];
            document.getElementById('email').innerHTML = response['email'];
        }
    });
</script>

</html>
