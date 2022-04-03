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
            <div class="breadcrumb-item"><a href="#">{{ __('Social') }}</a></div>
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
                            <h4>{{__('Social Setting')}}</h4>

                        </div>
                        <div class="card-body ">
                            <form method="post">
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{__('Facebook')}}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="facebook" value="{{$data[12]['value']}}"
                                                    class="form-control ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{__('Instagram')}}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fab fa-instagram"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="Instagram" value="{{$data[15]['value']}}"
                                                    class="form-control ">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{__('Twitter')}}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fab fa-twitter"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="twitter" value="{{$data[13]['value']}}"
                                                    class="form-control ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{__('LinkedIn')}}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fab fa-linkedin-in"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="linkedin" value="{{$data[14]['value']}}"
                                                    class="form-control ">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{__('YouTube')}}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fab fa-youtube"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="youtube" value="{{$data[16]['value']}}"
                                                    class="form-control ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{__('Pinterest')}}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fab fa-pinterest-p"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="pinterest" value="{{$data[17]['value']}}"
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