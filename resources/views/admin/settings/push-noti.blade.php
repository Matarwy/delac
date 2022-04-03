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
            <div class="breadcrumb-item"><a href="#">{{ __('One Signal Login') }}</a></div>
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
                            <h4>{{__('One Signal  Setting')}}</h4>

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
                                            <label>{{ __('One Signal APP ID') }}</label>
                                            <input type="text" class="form-control" name="APP_ID"
                                                value="{{env("APP_ID")}}" placeholder="{{__('One Signal APP ID')}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('One Signal REST API KEY') }}</label>
                                            <input type="text" class="form-control" name="REST_API_KEY"
                                                value="{{env("REST_API_KEY")}}"
                                                placeholder="{{__('One Signal REST API KEY')}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('One Signal USER AUTH KEY') }}</label>
                                            <input type="text" class="form-control" name="USER_AUTH_KEY"
                                                value="{{env("USER_AUTH_KEY")}}"
                                                placeholder="{{__('One Signal USER AUTH KEY')}}">
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