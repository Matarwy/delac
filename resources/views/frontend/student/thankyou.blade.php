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
                            <h1 class="thnk_coming_title">{{__('Thank You')}}</h1>
                            <h4 class="thnk_title1">{{__('Your Order is Confirmed!')}}</h4>
                            <p class="thnk_des">{{__('Please go back to home to')}} <span>
                                    {{__('complate your order')}}</span>
                                - <a href="{{ url('/') }}">{{__('Click Here')}}</a></p>
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