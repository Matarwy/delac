@extends('layouts.authmaster')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h4>{{__('Login')}}</h4>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">{{__('Email')}}</label>
                <input aria-describedby="emailHelpBlock" id="email" type="email"
                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                    placeholder="{{__('Email')}}" tabindex="1" value="{{ old('email') }}" autofocus>
                <div class="invalid-feedback">
                    {{ $errors->first('email') }}
                </div>

            </div>

            <div class="form-group">
                <div class="d-block">
                    <label for="password" class="control-label">{{__('Password')}}</label>
                    <div class="float-right">
                       
            </div>
    </div>
    <input aria-describedby="passwordHelpBlock" id="password" type="password" placeholder="{{__('Password')}}"
        class="form-control{{ $errors->has('password') ? ' is-invalid': '' }}" name="password" tabindex="2">
    <div class="invalid-feedback">
        {{ $errors->first('password') }}
    </div>

</div>

<div class="form-group">
    <div class="custom-control custom-checkbox">
        <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember"
            {{ old('remember') ? ' checked': '' }}>
        <label class="custom-control-label" for="remember">{{__('Remember Me')}}</label>
    </div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
        {{__('Login')}}
    </button>
</div>
</form>
</div>
</div>

@endsection