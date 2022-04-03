@extends('layouts.admin-master')

@section('title')
{{ __('Languages') }}
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{ __('Languages') }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">{{ __('Home') }}</a></div>
            <div class="breadcrumb-item"><a href="#">{{ __('Languages') }}</a></div>
        </div>
    </div>

    <div class="section-body">


        <x-alert-msg></x-alert-msg>
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header d-felx justify-content-between">
                        <h4>{{ __('Edit Language Detailt') }}</h4>
                        <a href="{{ route('download.langFile', ['lang'=>'en']) }}" class="btn btn-sm btn-primary">
                            {{__('Download base file')}}
                        </a>
                        <a href="{{ route('download.langFile', ['lang'=>$language->short_name]) }}"
                            class="btn btn-sm btn-info">
                            {{__('Download currant file')}}
                        </a>
                    </div>

                    <!--begin::form-->
                    <ul class="nav nav-tabs profile-nav mb-4" id="profileTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="nav-tab" data-toggle="tab" href="#nav-home" role="tab"
                                aria-controls="timeline" aria-selected="false">{{__('Dynamic')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
                                aria-controls="about" aria-selected="true">{{__('Summary ')}}</a>
                        </li>

                    </ul>
                    <div class="tab-content ul-tab__content" id="nav-tabContent">
                        <div class="tab-pane fade active show" id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab">

                            <form enctype="multipart/form-data" action="{{ route("web-language.update", [$language->id]) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-row ">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4" class="ul-form__label">{{__('Name:')}}</label>
                                            <input type="text" name="name"
                                                class="form-control  @error('name') invalid-input @enderror"
                                                placeholder="{{__('Please Enter name')}}" autofocus required
                                                value="{{$language->name}}">

                                            @error('name')
                                            <div class="invalid-div">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4"
                                                class="ul-form__label">{{__('Short Name:')}}</label>
                                            <input type="text" name="short_name"
                                                class="form-control  @error('short_name') invalid-input @enderror"
                                                placeholder="{{__('Please Enter short name')}}" required minlength="2"
                                                maxlength="2" readonly value="{{$language->short_name}}">

                                            @error('short_name')
                                            <div class="invalid-div">{{ $message }}</div>
                                            @enderror
                                        </div>
                                       
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4"
                                                class="ul-form__label">{{__('Language File:')}}</label>
                                            <input type="file" name="language_file"
                                                class="form-control file-input  @error('language_file') invalid-input @enderror"
                                                accept="application/JSON">
                                            @error('language_file')
                                            <div class="invalid-div">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer bg-transparent">
                                    <div class="mc-footer">
                                        <div class="row">
                                            <div class="col-lg-12 text-right">
                                                <button type="submit"
                                                    class="btn btn-raised ripple btn-raised-primary m-1">{{__('Submit')}}</button>
                                                <button type="reset"
                                                    class=" btn btn-raised ripple btn-raised-secondary m-1">{{__('Reset')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <form enctype="multipart/form-data" action="{{ route("web-language.update", [$language->id]) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-lg-12 col-xl-12">
                                        <div class="card-body">
                                            <div class="form-row">
                                                @foreach ($lang as $obj => $key)
                                                <div class="form-group col-md-12 col-lg-6">
                                                    <label for="inputEmail4" class="ul-form__label">{{$obj}}:</label>
                                                    <input type="text" name="{{$obj}}" class="form-control"
                                                        value="{{ $key}}">

                                                    @error('name')
                                                    <div class="invalid-div">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                @endforeach

                                            </div>

                                        </div>
                                        <div class="card-footer bg-transparent">
                                            <div class="mc-footer">
                                                <div class="row">
                                                    <div class="col-lg-12 text-right">
                                                        <button type="submit"
                                                            class="btn btn-raised ripple btn-raised-primary m-1">{{__('Submit')}}</button>
                                                        <button type="reset"
                                                            class=" btn btn-raised ripple btn-raised-secondary m-1">{{__('Reset')}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection