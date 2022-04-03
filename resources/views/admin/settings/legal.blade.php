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
            <div class="breadcrumb-item"><a href="#">{{ __('legal') }}</a></div>
        </div>
    </div>

    <div class="section-body">
        <x-alert-msg></x-alert-msg>
        <div class="row">

            <div class="col-12 col-md-12 col-lg-12 ">
                <form action="{{ route('setting.update') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4>{{__('Privacy Policy')}}</h4>

                        </div>
                        <div class="card-body ">
                            <form method="post">
                                <textarea class="summernote" name="p_p">{{$data[1]['value']}}</textarea>
                            </form>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary" type="submit">{{__('Submit')}}</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-12 col-lg-12 ">
                <form action="{{ route('setting.update') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4>{{__('Terms & Conditions')}}</h4>

                        </div>
                        <div class="card-body ">
                            <form method="post">
                                <textarea class="summernote" name="terms">{{$data[2]['value']}}</textarea>
                            </form>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary" type="submit">{{__('Submit')}}</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-12 col-lg-12 ">
                <form action="{{ route('setting.update') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4>{{__('Copyright Policy')}}</h4>

                        </div>
                        <div class="card-body ">
                            <form method="post">
                                <textarea class="summernote" name="c_p">{{$data[0]['value']}}</textarea>
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
<script>
    "use strict";
    setTimeout(() => {
        $('.summernote').summernote({
            placeholder: 'Please Enter something great',
            tabsize: 2,
            height: 100
            });
    }, 3000);
</script>