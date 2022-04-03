<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=9">
    {!! SEO::generate() !!}
    <title>{{env("APP_NAME")}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="theme-color" content="#7209B7">
    <link rel="manifest" href="{{ asset('manifest.json')}}">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="{{env("APP_NAME")}}">
    <link rel="icon" sizes="512x512" href="{{ asset('frontend/images/fav.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('frontend/images/fav.png') }}">
    <link rel="icon" sizes="192x192" href="{{ asset('frontend/images/fav.png') }}">
    @include('frontend.inc.styles')

</head>

<body>
    
    @if(Auth::guard('instructor')->check())
        @include('frontend.inc.ins-topnav')
    @else
    @php
    $categorys = \App\Models\Category::whereStatus(1)->orderBy('name','asc')->get();
    @endphp
        @include('frontend.inc.stu-topnav')
    @endif
    
    @if(Auth::guard('instructor')->check())
        @include('frontend.inc.ins-navbar')
    @else
        @include('frontend.inc.stu-navbar')
    @endif
    
    <div class="wrapper" >
        <div class="sa4d25" >
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
        @include('frontend.inc.ins-footer')
    </div>
    
    @include('frontend.inc.scripts')
    <x-snackbar />

</body>

</html>