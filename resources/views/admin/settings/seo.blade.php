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
            <div class="breadcrumb-item"><a href="#">{{ __('SEO') }}</a></div>
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
                            <h4>{{__('SEO Setting')}}</h4>

                        </div>
                        <div class="card-body ">
                            <form method="post">
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('SEO Title') }}</label>
                                            <input type="text" name="seo_title" class="form-control"
                                                value="{{ $data[27]['value'] }}" placeholder="{{__('SEO Title')}}"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('SEO Description') }}</label>
                                            <input type="text" name="seo_description" class="form-control"
                                                value="{{ $data[28]['value'] }}" placeholder="{{__('SEO Description')}}"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('SEO twitter Title') }}</label>
                                            <input type="text" name="seo_twitter_title" class="form-control"
                                                value="{{ $data[30]['value'] }}"
                                                placeholder="{{__('SEO twitter  Title')}}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('SEO Canonical') }}</label>
                                            <input type="text" name="seo_canonical" class="form-control"
                                                value="{{ $data[31]['value'] }}" placeholder="{{__('SEO Canonical')}}"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('Meta Tag') }}</label>
                                            <select multiple name="seo_meta[]" class="form-control select2-tag"
                                                required>
                                                @foreach (explode(',',$data[29]['value']) as $item)
                                                <option value="{{$item}}" selected>{{$item}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('Meta tag image') }}</label>
                                            <input type="file" name="seo_image" class="form-control-file "
                                                accept="image/png">
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