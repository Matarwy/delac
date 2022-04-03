<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="" content="Cursus">
    <title>Cursus</title>


   <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    
    <style>
        body {
            background: #e9ecef;
        }
    </style>
</head>

<body translate="no">
    <div class="jumbotron text-center">
        <h1 class="display-3">Thank You!</h1>
        <p class="lead">
            <strong class="d-block">Thanks for purchase Cursus </strong>
            <br>
            <strong class="d-block"><b>Renew Licence</b></strong>
            <br>
            Your License <strong>Deactive</strong> Please Active Again.
        </p>
        <hr>
        <div class="row">
            <div class="col-6 offset-md-3">

                <form role="form" method="POST" action="{{ url('activeLicence') }}">
                    @csrf
                    <div class="form-group{{ $errors->has('license_code') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-license_code">{{ __('License code') }}</label>
                        <input type="text" name="license_code" id="input-license_code"
                            class="form-control form-control-alternative{{ $errors->has('license_code') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('License code') }}" required autofocus>
                        @if ($errors->has('license_code'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('license_code') }}</strong>
                        </span>
                        @endif
                        @if(Session::has('status'))
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{Session::get('status')}}</strong>
                        </span>
                        @endif
                    </div>



                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-name">{{ __('Your name') }}</label>
                        <input type="text" name="name" id="input-name"
                            class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('Your Name') }}" required>
                        @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="custom-control custom-control-alternative custom-checkbox">
                    </div>
                    <div class="text-center login-btn">
                        <button type="submit" class="btn btn-primary my-4"> {{ __('Submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>