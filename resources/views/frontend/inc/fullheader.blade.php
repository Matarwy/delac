<header class="header clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="back_link">
                    @if(Auth::guard('instructor')->check())
                    <a href="{{ route('ins-home') }}" class="hde151">{{__('Back To Delac')}}</a>
                    <a href="{{ route('ins-home') }}" class="hde152">{{__('Back')}}</a>
                    @else
                    <a href="{{ url('/') }}" class="hde151">{{__('Back To Delac')}}</a>
                    <a href="{{ url('/') }}" class="hde152">{{__('Back')}}</a>
                    @endif
                </div>
                <div class="ml_item">
                    <div class="main_logo main_logo15" id="logo">
                        @if(Auth::guard('instructor')->check())
                        <a href="{{ route('ins-home') }}"><img src="{{ asset('frontend/images/logo.svg') }}" alt=""></a>
                        <a href="{{ route('ins-home') }}"><img class="logo-inverse"
                                src="{{ asset('frontend/images/ct_logo.svg') }}" alt=""></a>
                        @else
                        <a href="{{ url('/') }}"><img src="{{ asset('frontend/images/logo.svg') }}" alt=""></a>
                        <a href="{{ url('/') }}"><img
                                class="{{ asset('frontend/logo-inverse" src="images/ct_logo.svg') }}" alt=""></a>
                        @endif
                    </div>
                </div>
                <div class="header_right pr-0">

                </div>
            </div>
        </div>
    </div>
</header>