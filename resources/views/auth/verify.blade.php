<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=9">

    <title>{{env("APP_NAME")}}</title>


    <link rel="icon" type="image/png" href="{{ asset('frontend/images/fav.png') }}">

    @include('frontend.inc.styles')

</head>

<body class="coming_soon_style">
    <div class="coming_soon_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="cmtk_group">
                        <div class="ct-logo">
                            <a href="{{ url('/') }}"><img src="{{ asset('frontend/images/ct_logo.svg') }}" alt=""></a>
                        </div>
                        <div class="cmtk_dt">
                            <h1 class="thnk_coming_title">{{__('You are Human?')}}</h1>
                            <h4 class="thnk_title1">
                                @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                                @endif
                            </h4>
                            <h4 class="thnk_title1">

                                {{ __('Before proceeding, please check your email for a verification link.') }}</h4>
                            <p class="thnk_des">{{ __('If you did not receive the email') }}</span>

                                @if(Auth::guard('instructor')->check())
                                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                    @else
                                    <form class="d-inline" method="POST" action="{{ route('stuverification.resend') }}">
                                        @endif
                                        <form class="d-inline" method="POST"
                                            action="{{ route('verification.resend') }}">
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-link p-0 m-0 align-baseline text-danger">{{ __('click here to request another') }}</button>.
                                        </form>
                        </div>
                      @include('frontend.inc.footer2')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('frontend.inc.scripts')

</body>

</html>