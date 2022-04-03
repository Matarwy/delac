@extends('frontend.layouts.authmaster')

@section('content')

<div class="sign_form">
    <h2>{{__('Welcome to')}} {{env("APP_NAME")}}</h2>
    <p>{{__('Sign Up and Start Learning!')}}</p>
    @if (Request::is('register'))
    <form method="POST" action="{{url('register')}}">
        @else
        <form method="POST" action="{{url('instructor/register')}}">
            @endif
            @csrf
            <input type="hidden" name="user_type" value="{{Request::is('register') ? 'student' : 'instructor'}}">
            <div class="ui search focus">
                <div class="ui left icon input swdh11 swdh19">
                    <input class="prompt srch_explore" type="text" name="name" value="" id="id_fullname" required=""
                        maxlength="64" placeholder="{{__('Full Name')}}">
<i class="uil uil-user icon icon2"></i>
                </div>
                @error('name')
                <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                @enderror
            </div>
            <div class="ui search focus mt-15">
                <div class="ui left icon input swdh11 swdh19">
                    <input class="prompt srch_explore" type="email" name="email" value="" id="id_email" required=""
                        maxlength="64" placeholder="{{__('Email')}}">
                        <i class="uil uil-envelope icon icon2"></i>

                </div>
                @error('email')
                <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                @enderror
            </div>
            <div class="ui search focus mt-15">
                <div class="ui left icon input swdh11 swdh19">
                    <input class="prompt srch_explore" type="password" name="password" value="" id="id_password"
                        required="" maxlength="50" placeholder="{{__('Password')}}">
                    <i class="uil uil-key-skeleton-alt icon icon2"></i>

                </div>
                @error('password')
                <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                @enderror
            </div>
            <div class="ui form mt-30 checkbox_sign">
                <div class="inline field">
                    <div class="ui checkbox mncheck">
                        <input type="checkbox" tabindex="0" class="hidden">
                        <label>{{__('I’m in for emails with exciting discounts and personalized recommendations')}}</label>
                    </div>
                </div>
            </div>
            <button class="login-btn" type="submit">{{__('Sign Up')}}</button>
        </form>
        <p class="sgntrm145">{{__('By signing up, you agree to our')}} <a href="{{ url('legal/'.'terms-conditions') }}">{{__('Terms of Use')}}</a> {{__('and')}} <a
                href="{{ url('legal/'.'privacy-policy') }}">{{__('Privacy Policy')}}</a>.</p>
                @if (Request::is('register'))
                <p class="mb-0 mt-30">{{__('Already have an account?')}} <a href="{{ url('login') }}">{{__('Log In')}}</a></p>
                @else
                <p class="mb-0 mt-30">{{__('Already have an account?')}} <a href="{{ url('instructor/login') }}">{{__('Log In')}}</a></p>
                @endif
</div>
@endsection