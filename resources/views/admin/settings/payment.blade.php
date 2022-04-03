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
            <div class="breadcrumb-item"><a href="#">{{ __('Payment') }}</a></div>
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
                            <h4>{{__('Payment Setting')}}</h4>

                        </div>
                        <div class="card-body ">
                            <form method="post">
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="form-group mb-0">
                                            <label>{{ __('Stripe Payment Gateway') }}</label>
                                            <select name="stripe" class="form-control select2-dd" required>
                                                <option value="1" {{ $data[22]['value'] == "1" ? 'selected' : '' }}>
                                                    {{__('On')}}</option>
                                                <option value="0" {{ $data[22]['value'] == "0" ? 'selected' : '' }}>
                                                    {{__('Off')}}</option>

                                            </select>
                                        </div>
                                    </div>



                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('Stripe Publish Key') }}</label>
                                            <input type="text" name="stripe_pk" class="form-control"
                                                value="{{ $data[23]['value'] }}" placeholder="{{__('stripe_pk')}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('Stripe Secret Key') }}</label>
                                            <input type="text" name="stripe_sk" class="form-control"
                                                value="{{ $data[24]['value'] }}" placeholder="{{__('stripe_sk')}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group mb-0">
                                            <label>{{ __('Razorpay Payment Gateway') }}</label>
                                            <select name="razorpay" class="form-control select2-dd" required>
                                                <option value="1" {{ $data[25]['value'] == "1" ? 'selected' : '' }}>
                                                    {{__('On')}}</option>
                                                <option value="0" {{ $data[25]['value'] == "0" ? 'selected' : '' }}>
                                                    {{__('Off')}}</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group mb-0">
                                            <label>{{ __('Paypal Payment Gateway') }}</label>
                                            <select name="paypal" class="form-control select2-dd" required>
                                                <option value="1" {{ $data[20]['value'] == "1" ? 'selected' : '' }}>
                                                    {{__('On')}}</option>
                                                <option value="0" {{ $data[20]['value'] == "0" ? 'selected' : '' }}>
                                                    {{__('Off')}}</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('RazorPay key') }}</label>
                                            <input type="text" name="razoprpay_key" class="form-control"
                                                value="{{ $data[26]['value'] }}" placeholder="{{__('rzp_key')}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('Paypal Client ID') }}</label>
                                            <input type="text" name="palypal_client_id" class="form-control"
                                                value="{{ $data[21]['value'] }}" placeholder="{{__('Client ID')}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-4">
                                        <div class="form-group mb-0">
                                            <label>{{ __('Paystack Payment Gateway') }}</label>
                                            <select name="paystack" class="form-control select2-dd" required>
                                                <option value="1" {{ $data[39]['value'] == "1" ? 'selected' : '' }}>
                                                    {{__('On')}}</option>
                                                <option value="0" {{ $data[39]['value'] == "0" ? 'selected' : '' }}>
                                                    {{__('Off')}}</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-4">
                                        <div class="form-group mb-0">
                                            <label>{{ __('Mollie Payment Gateway') }}</label>
                                            <select name="mollie" class="form-control select2-dd" required>
                                                <option value="1" {{ $data[37]['value'] == "1" ? 'selected' : '' }}>
                                                    {{__('On')}}</option>
                                                <option value="0" {{ $data[37]['value'] == "0" ? 'selected' : '' }}>
                                                    {{__('Off')}}</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-4">
                                        <div class="form-group mb-0">
                                            <label>{{ __('Flutterwave Payment Gateway ') }}</label>
                                            <select name="flutterwave" class="form-control select2-dd" required>
                                                <option value="1" {{ $data[35]['value'] == "1" ? 'selected' : '' }}>
                                                    {{__('On')}}</option>
                                                <option value="0" {{ $data[35]['value'] == "0" ? 'selected' : '' }}>
                                                    {{__('Off')}}</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label>{{ __('Paystack key') }}</label>
                                            <input type="text" name="paystack_key" class="form-control"
                                                value="{{ $data[40]['value'] }}" placeholder="{{__('Paystack Key')}}">
                                        </div>
                                    </div>


                                    <div class="col-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label>{{ __('Mollie Key') }}</label>
                                            <input type="text" name="mollie_key" class="form-control"
                                                value="{{ $data[38]['value'] }}" placeholder="{{__('Mollie Key')}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label>{{ __('Flutterwave Key') }}</label>
                                            <input type="text" name="flutterwave_key" class="form-control"
                                                value="{{ $data[36]['value'] }}"
                                                placeholder="{{__('Flutterwave Key')}}">
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