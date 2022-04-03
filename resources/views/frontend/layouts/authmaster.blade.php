<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=9">

    {!! SEO::generate() !!}
    <title>{{env("APP_NAME")}}</title>


  
    <link rel="icon" type="image/png" href="{{ asset('frontend/images/fav.png') }}">


    @include('frontend.inc.styles')
    <style>
        .sign_in_up_bg:before {

            background: url("{{ asset('frontend/images/sign.svg') }}") no-repeat center !important;
        }
    </style>
</head>
<div class="sign_in_up_bg">
    <div class="container">
        <div class="row justify-content-lg-center justify-content-md-center">
            <div class="col-lg-12">
                <div class="main_logo25" id="logo">
                    <a href="{{url('/')}}"><img src="{{ asset('frontend/images/logo.svg') }}" alt=""></a>
                    <a href="{{url('/')}}"><img class="logo-inverse" src="{{ asset('frontend/images/ct_logo.svg') }}"
                            alt=""></a>
                </div>
            </div>

            <div class="col-lg-6 col-md-8">

                @yield("content")
                <div class="sign_footer">
                    <img src="{{ asset('frontend/images/sign_logo.png')}}" alt="">© {{date('Y')}}
                    <strong>{{env("APP_NAME")}}</strong>. {{__('All
                    Rights Reserved.')}}
                </div>
            </div>
        </div>
    </div>
</div>

<body>

    @include('frontend.inc.scripts')
    <x-snackbar />

</body>

</html>