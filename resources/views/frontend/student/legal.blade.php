<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=9">
    <title>{{$title}} - {{env("APP_NAME")}}</title>

    
    <link rel="icon" type="image/png" href="{{ asset('frontend/images/fav.png') }}">

    @include('frontend.inc.styles')

</head>

<body>
    
    @include('frontend.inc.fullheader')
    
    
    <div class="wrapper _bg4586 _new89">
        <div class="_215b15">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="title125">
                            <div class="titleleft">
                                <div class="ttl121">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('Home')}}</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>

                        </div>
                        <div class="title126">
                            <h2>{{$title}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="faq1256">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-5">
                        <div class="fcrse_3 frc123">
                            <ul class="ttrm15">
                                <li><a href="{{ url('legal/'.'terms-conditions') }}" class="tt_item active">{{__('Terms &
                                        conditions')}}</a></li>
                                <li><a href="{{ url('legal/'.'privacy-policy') }}"
                                        class="tt_item">{{__('Privacy Policy')}}</a>
                                </li>

                                <li><a href="{{ url('legal/'.'copyright-policy') }}"
                                        class="tt_item">{{__('Copyright Policy')}}</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-7">
                        {!! clean( $data)!!}
                    </div>
                </div>
            </div>
        </div>

        @include('frontend.inc.ins-footer')
    </div>
    

    @include('frontend.inc.scripts')

</body>

</html>