@extends('layouts.admin-master')

@section('title')
{{ __('Notification template') }}
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{ __('Notification template') }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">{{ __('Home') }}</a></div>
            <div class="breadcrumb-item"><a href="#">{{ __('Notification template') }}</a></div>
        </div>
    </div>

    <div class="section-body">
        
        <x-alert-msg></x-alert-msg>
        <div class="row">

            <div class="col-12 col-md-12 col-lg-12 ">
                <div class="card">
                    <div class="card-header">
                        <h4>Template</h4>
                    </div>
                    <div class="card-body">

                        <div class="mb-2">

                            <span class="badge badge-primary">@{{student_name}}</span>
                            <span class="badge badge-secondary">@{{course_title}}</span>
                            <span class="badge badge-dark">@{{otp}}</span>
                            <span class="badge badge-warning">@{{instructor_title}}</span>
                            <span class="badge badge-danger">@{{sell_date}}</span>
                            <span class="badge badge-dark">@{{amount}}</span>
                            <span class="badge badge-info">@{{remark}}</span>
                            <span class="badge badge-warning">@{{status}}</span>
                            <span class="badge badge-success">@{{review}}</span>
                        </div>

                        <ul class="nav nav-pills mb-2" id="myTab2" role="tablist">
                            @foreach ($notis as $item)
                            <li class="nav-item">
                                <a class="nav-link {{$loop->first ? 'active show' : ''}} " id="home-tab{{$item->id}}"
                                    data-toggle="tab" href="#home{{$item->id}}" role="tab" aria-controls="home"
                                    aria-selected="{{$item->first ? 'true' : 'false'}}">{{$item->for_what}}</a>
                            </li>
                            @endforeach

                        </ul>
                        <div class="tab-content" id="myTab3Content">
                            @foreach ($notis as $item)
                            <div class="tab-pane fade {{$loop->first ? 'active show' : ''}}" id="home{{$item->id}}"
                                role="tabpanel" aria-labelledby="home-tab{{$item->id}}">
                                <form action="{{ route('noti-template.update', [$item->id]) }}" method="POST">

                                    @csrf
                                    @method("PUT")
                                    <div class="card-body">
                                        <div class="row ">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <label>{{ __('Push Notification') }}</label>
                                                    <input type="text" name="noti_title"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        required maxlength="255" value="{{$item->noti_title}}">
                                                </div>
                                               
                                            </div>
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <label>{{ __('Email Subject') }}</label>
                                                    <input type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        required maxlength="255" value="{{$item->subject}}" name="subject">
                                                </div>
                                               
                                            </div>
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <label>{{ __('Email Body') }}</label>
                                                    <textarea cols="30" rows="10"
                                                        class="form-control summernote" name="email_title">{{$item->email_title}}</textarea>
                                                </div>
                                               
                                            </div>



                                        </div>

                                    </div>

                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary" type="submit">{{__('Submit')}}</button>
                                    </div>
                                </form>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
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