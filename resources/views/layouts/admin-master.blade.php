<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') - {{env("APP_NAME")}}</title>
<link rel="icon" type="image/png" href="{{ asset('frontend/images/fav.png') }}">
    
    
    
    @include('inc.styles')

</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                
                @include('inc.topnav')

            </nav>
            <div class="main-sidebar">
                
                @include('inc.navbar')

            </div>

            
            <div class="main-content">
                
                @yield('content')
            </div>
            @include('inc.footer')

        </div>
    </div>

    
    
    @include('inc.scripts')

    
</body>

</html>