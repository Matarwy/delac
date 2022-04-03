<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login - {{env("APP_NAME")}}</title>
    <link rel="icon" type="image/png" href="{{ asset('frontend/images/fav.png') }}">
    <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/font-awesome.min.css')}}" rel="stylesheet">
   
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/components.css') }}">
</head>

<body >
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div
                        class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <i class="fas fa-book-reader text-primary auth-icon" ></i>

                        </div>
                        @if(session()->has('info'))
                        <div class="alert alert-primary">
                            {{ session()->get('info') }}
                        </div>
                        @endif
                        @if(session()->has('status'))
                        <div class="alert alert-info">
                            {{ session()->get('status') }}
                        </div>
                        @endif
                        @yield('content')
                        <div class="simple-footer">
                            Copyright &copy; {{ env('APP_NAME') }} {{ date('Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

   <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/popper.min.js')}}">
</script>
<script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/nicescroll.min.js')}}"></script>
    <script src="{{ asset('admin/assets/js/stisla.js') }}"></script>

    <script src="{{ asset('admin/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('admin/assets/js/custom.js') }}"></script>

</body>

</html>