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
                        <h4>{{ __('New Language Detailt') }}</h4>
                        <a href="{{ route('download.langFile', ['lang'=>'en']) }}" class="btn btn-sm btn-primary">
                            {{__('Download base file')}}
                        </a>
                    </div>

                    <!--begin::form-->
                    <form enctype="multipart/form-data" action="{{ route('web-language.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-row ">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4" class="ul-form__label">{{__('Name:')}}</label>
                                    <input type="text" name="name"
                                        class="form-control  @error('name') invalid-input @enderror"
                                        placeholder="{{__('Please Enter name')}}" autofocus required>

                                    @error('name')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4" class="ul-form__label">{{__('Short Name:')}}</label>
                                    <input type="text" name="short_name"
                                        class="form-control  @error('short_name') invalid-input @enderror"
                                        placeholder="{{__('Please Enter short name')}}" required minlength="2"
                                        maxlength="2">

                                    @error('short_name')
                                    <div class="invalid-div">{{ $message }}</div>
                                    @enderror
                                </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4" class="ul-form__label">{{__('Language File:')}}</label>
                                <input type="file" name="language_file"
                                    class="form-control file-input  @error('language_file') invalid-input @enderror"
                                    required accept="application/JSON">
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
                                    class="btn btn-primary m-1">{{__('Submit')}}</button>
                                <button type="reset"
                                    class=" btn btn-secondary m-1">{{__('Reset')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
                </form>

            </div>
        </div>
    </div>
    </div>
</section>
@endsection