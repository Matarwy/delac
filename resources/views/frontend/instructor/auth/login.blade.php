@extends('frontend.layouts.authmaster')

@section('content')
<div class="sign_form">
    <h2>{{__('Welcome Back')}}</h2>
    <p>{{__('Log In to Your  Account!')}}</p>
    @php
    $start = Request::is('login') ? 'student/' : 'instructor/';
    @endphp
    @if (env("FB_LOGIN") == 1)
    <button class="social_lnk_btn color_btn_fb"
        onclick="window.location.href = '{{ url($start.'auth/facebook/redirect') }}';"><i
            class="uil uil-facebook-f"></i>{{__('Continue with Facebook')}}</button>
    @endif
    @if (env("TWITTER_LOGIN") == 1)
    <button class="social_lnk_btn mt-15 color_btn_tw"
        onclick="window.location.href = '{{ url($start.'auth/twitter/redirect') }}';"><i
            class="uil uil-twitter"></i>{{__('Continue with Twitter')}}</button>
    @endif
    @if (env("GOOGLE_LOGIN") == 1)
    <button class="social_lnk_btn mt-15 color_btn_go"
        onclick="window.location.href = '{{ url($start.'auth/google/redirect') }}';"><i
            class="uil uil-google"></i>{{__('Continue with Google')}}</button>
    @endif
    @if (Request::is('login'))
    <form method="POST" action="{{url('login')}}">
        @else
        <form method="POST" action="{{url('instructor/login')}}">
            @endif
            @csrf
            <div class="ui search focus mt-15">
                <div class="ui left icon input swdh95">
                    <input class="prompt srch_explore " type="email" name="email" value="" id="id_email" required=""
                        maxlength="64" placeholder="{{__('Email Address')}}">
                    <i class="uil uil-envelope icon icon2"></i>
                </div>
            </div>
            <div class="ui search focus mt-15">
                <div class="ui left icon input swdh95">
                    <input class="prompt srch_explore" type="password" name="password" value="" id="id_password"
                        required="" maxlength="50" placeholder="{{__('Password')}}">
                    <i class="uil uil-key-skeleton-alt icon icon2"></i>
                </div>
            </div>
            <div class="ui form mt-30 checkbox_sign">
                <div class="inline field">
                    <div class="ui checkbox mncheck">
                        <input type="checkbox" tabindex="0" class="hidden" name="remember">
                        <label>{{__('Remember Me')}}</label>
                    </div>
                </div>
            </div>
            <button class="login-btn" type="submit">{{__('Sign In')}}</button>
        </form>

        @if (Request::is('login'))
        <p class="sgntrm145">{{__('Or')}} <a
                href="{{ route('student.showResetEmailForm', ['user_type'=>'students']) }}">{{__('Forgot
                Password')}}</a>?
        </p>
        <p class="mb-0 mt-30 hvsng145">{{__('Don`t have an account?')}} <a
                href="{{ url('register') }}">{{__('Sign Up')}}</a></p>
        @else
        <p class="sgntrm145">{{__('Or')}} <a
                href="{{ route('instructor.showResetEmailForm', ['user_type'=>'instructors']) }}">{{__('Forgot
                Password')}}</a>?
        </p>
        <p class="mb-0 mt-30 hvsng145">{{__('Don`t have an account?')}} <a
                href="{{ url('instructor/register') }}">{{__('Sign Up')}}</a></p>
        @endif
</div>

@endsection