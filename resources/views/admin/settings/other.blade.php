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
            <div class="breadcrumb-item"><a href="#">{{ __('Other') }}</a></div>
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
                            <h4>{{__('Other Setting')}}</h4>

                        </div>
                        <div class="card-body ">
                            <form method="post">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Instructor Verification') }}</label>
                                            <select name="instructor_verification" class="form-control select2-dd"
                                                required>
                                                <option value="1" {{ $data[10]['value'] == "1" ? 'selected' : '' }}>
                                                    {{__('On')}}</option>
                                                <option value="0" {{ $data[10]['value'] == "0" ? 'selected' : '' }}>
                                                    {{__('Off')}}</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 ">
                                        <div class="form-group">
                                            <label>{{ __('Student Verification') }}</label>
                                            <select name="user_verification" class="form-control select2-dd" required>
                                                <option value="1" {{ $data[11]['value'] == "1" ? 'selected' : '' }}>
                                                    {{__('On')}}</option>
                                                <option value="0" {{ $data[11]['value'] == "0" ? 'selected' : '' }}>
                                                    {{__('Off')}}</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('Subscriber needed for Verification') }}</label>
                                            <input type="number" name="verification_subscriber" class="form-control"
                                                value="{{ $data[18]['value'] }}"
                                                placeholder="{{__('Subscriber needed for Verification')}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('Sell needed for Verification') }}</label>
                                            <input type="number" name="verification_sell" class="form-control"
                                                value="{{ $data[19]['value'] }}"
                                                placeholder="{{__('Sell needed for Verification')}}">
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