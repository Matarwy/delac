<footer class="footer mt-40">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-9 col-md-9">
                <div class="item_f1">
                    <a href="{{ url('legal/'.'copyright-policy') }}">{{__('Copyright Policy')}}</a>
                    <a href="{{ url('legal/'.'terms-conditions') }}">{{__('Terms')}}</a>
                    <a href="{{ url('legal/'.'privacy-policy') }}">{{__('Privacy Policy')}}</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="item_f1">

                    <div class="lng_btn mt-0">
                        <div class="ui language bottom right pointing dropdown floating" id="languages"
                            data-content="Select Language">
                            <a href="#"><i class='uil uil-globe lft'></i>Language<i
                                    class='uil uil-angle-down rgt'></i></a>
                            <div class="menu">
                                <div class="scrolling menu">
                                    <div class="item" data-percent="100" data-value="en" data-english="English"
                                        onclick="window.location.href ='{{ route('locale.change',['locale' => 'en']) }}';">
                                        <span class="description">English</span>
                                        en
                                    </div>
                                    @foreach ($weblang as $webl)
                                    <div class="item" data-percent="100" data-value="en" data-english="English"
                                        onclick="window.location.href ='{{ route('locale.change',['locale' => $webl->short_name]) }}';">
                                        <span class="description">{{$webl->name}}</span>
                                        {{$webl->short_name}}
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="footer_bottm">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="fotb_left">
                                <li>
                                    <a href="{{url('/')}}">
                                        <div class="footer_logo">
                                            <img src="{{ asset('frontend/images/logo1.svg')}}" alt="">
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <p>© {{date('Y')}}
                                        <strong>{{env("APP_NAME")}}</strong>.{{__(' All Rights Reserved.')}}</p>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <div class="edu_social_links">
                                <a href="http://facebook.com/{{$admin_setting[12]['value']}}"><i class="fab fa-facebook-f"></i></a>
                                <a href="http://twitter.com/{{$admin_setting[13]['value']}}"><i class="fab fa-twitter"></i></a>
                                <a href="http://www.linkedin.com/{{$admin_setting[14]['value']}}"><i class="fab fa-linkedin-in"></i></a>
                                <a href="http://www.instagram.com/{{$admin_setting[15]['value']}}"><i class="fab fa-instagram"></i></a>
                                <a href="http://www.youtube.com/{{$admin_setting[16]['value']}}"><i class="fab fa-youtube"></i></a>
                                <a href="http://www.pinterest.com/{{$admin_setting[17]['value']}}"><i class="fab fa-pinterest-p"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>