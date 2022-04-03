@extends('layouts.admin-master')

@section('title')
{{ __('Settings') }}
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{ __('Settings') }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">{{ __('Home') }}</a></div>
            <div class="breadcrumb-item"><a href="#">{{ __('Settings') }}</a></div>
            <div class="breadcrumb-item"><a href="#">{{ __('Social Login') }}</a></div>
        </div>
    </div>

    <div class="section-body">
        <x-alert-msg></x-alert-msg>
        <div class="row">

            <div class="col-12 col-md-12 col-lg-12 ">
                <form action="{{ route('setting.update') }}" method="POST" autocomplete="off"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4>{{__('Social Login Setting')}}</h4>

                        </div>
                        <div class="card-body ">
                            <form method="post">
                                <div class="row">
                                    <div class="col-4 ">
                                        <div class="form-group mb-0">
                                            <label>{{ __('Google Social Login') }}</label>
                                            <select name="GOOGLE_LOGIN" class="form-control select2-dd" required>
                                                <option value="0" {{ env("GOOGLE_LOGIN") == "0" ? 'selected' : '' }}>
                                                    {{__('Off')}}</option>
                                                <option value="1" {{ env("GOOGLE_LOGIN") == "1" ? 'selected' : '' }}>
                                                    {{__('On')}}</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4 ">
                                        <div class="form-group mb-0">
                                            <label>{{ __('Facebook Social Login') }}</label>
                                            <select name="FB_LOGIN" class="form-control select2-dd" required>
                                                <option value="0" {{ env("FB_LOGIN") == "0" ? 'selected' : '' }}>
                                                    {{__('Off')}}</option>
                                                <option value="1" {{ env("FB_LOGIN") == "1" ? 'selected' : '' }}>
                                                    {{__('On')}}</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4 ">
                                        <div class="form-group mb-0">
                                            <label>{{ __('Twitter Social Login') }}</label>
                                            <select name="TWITTER_LOGIN" class="form-control select2-dd" required>
                                                <option value="0" {{ env("TWITTER_LOGIN") == "0" ? 'selected' : '' }}>
                                                    {{__('Off')}}</option>
                                                <option value="1" {{ env("TWITTER_LOGIN") == "1" ? 'selected' : '' }}>
                                                    {{__('On')}}</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{__('Facebook Client ID')}}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="FB_CLIENT_ID" value="{{env("FB_CLIENT_ID")}}"
                                                    class="form-control ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{__('Facebook Client Secret')}}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="FB_CLIENT_SECRET" value="{{env("FB_CLIENT_SECRET")}}"
                                                    class="form-control ">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{__('Twitter Client ID')}}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fab fa-twitter"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="TWITTER_CLIENT_ID" value="{{env("TWITTER_CLIENT_ID")}}"
                                                    class="form-control ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{__('Twitter Client Secret')}}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fab fa-twitter"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="TWITTER_CLIENT_SECRET" value="{{env("TWITTER_CLIENT_SECRET")}}"
                                                    class="form-control ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{__('Google Client ID')}}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fab fa-google"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="GOOGLE_CLIENT_ID" value="{{env("GOOGLE_CLIENT_ID")}}"
                                                    class="form-control ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{__('Google Client Secret')}}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fab fa-google"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="GOOGLE_CLIENT_SECRET" value="{{env("GOOGLE_CLIENT_SECRET")}}"
                                                    class="form-control ">
                                            </div>
                                        </div>
                                    </div>




                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary" type="submit">{{__('Submit')}}</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

</section>

@endsection