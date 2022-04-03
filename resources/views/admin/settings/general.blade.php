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
            <div class="breadcrumb-item"><a href="#">{{ __('General') }}</a></div>
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
                            <h4>{{__('General Setting')}}</h4>

                        </div>
                        <div class="card-body ">
                            <form method="post">
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('Admin Commission') }}</label>
                                            <input type="number" name="admin_commission" class="form-control"
                                                value="{{ $data[5]['value'] }}" min="1" max="99"
                                                placeholder="{{__('Percent (eg. 20 for 20%)')}}" required>
                                        </div>
                                    </div>
                                  
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('Currency Code') }}</label>
                                            <input type="text" name="currency_code" class="form-control"
                                                value="{{ $data[6]['value'] }}"
                                                placeholder="{{__('USD or INR or ETC')}}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('Currency Symbol') }}</label>
                                            <input type="text" name="currency_symbole" class="form-control"
                                                value="{{ $data[7]['value'] }}" placeholder="{{__('$')}}" required>
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