@extends('frontend.layouts.ins-master')

@push('styles')


@endpush
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2 class="st_title"><i class="uil uil-check-circle"></i> {{__('Verification')}}</h2>
    </div>
</div>
<div class="row justify-content-xl-center justify-content-lg-center justify-content-md-center">
    <div class="col-xl-6 col-lg-8 col-md-8">
        <div class="verification_content">
            <img src=" {{ asset('frontend/images/verified-account.svg') }}" alt="">
            <h4>{{__('Verification with')}} {{env("APP_NAME")}}+</h4>
            <p>{{__('Praesent sed sapien gravida, tempus nunc nec, euismod turpis. Mauris quis scelerisque arcu. Quisque et
                aliquet nisl, id placerat est. Morbi quis imperdiet nulla.')}}</p>
            <ul class="alert_verification">
                <li>
                    <div class="required_group">
                        <div class="edututs_required_img">
                            <i class="uil uil-dashboard"></i>
                        </div>
                        <div class="edututs_required">
                            <span><strong>{{$state['subscription']}} {{__('subscribers')}}</strong></span>
                            <span>{{$admin_setting[18]['value']}} {{__('required')}}</span>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="required_group">
                        <div class="edututs_required_img">
                            <i class="uil uil-dashboard"></i>
                        </div>
                        <div class="edututs_required">
                            <span><strong>{{$state['order']}} {{__('sell')}}</strong></span>
                            <span>{{$admin_setting[19]['value']}} {{__('required')}}</span>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="apply_verify_text"><i class="uil uil-check-circle"></i>{{__('We`ll send you an email when you`re
                Verify with')}} {{env("APP_NAME")}}+</div>
            <div class="verification_form">
                @if (auth()->user()->verify_pro == 1)
                <h4 class="text-success">{{__('You are allready verify with')}} {{env("APP_NAME")}}+</h4>
                @elseif( $state['order'] < $admin_setting[19]['value'] && $state['subscription'] < $admin_setting[18]['value'] ) <h4 class="text-danger">
                    {{__('You are not eligible to verify your account on ')}}
                    {{env("APP_NAME")}}+
                    </h4>
                    @elseif($vreq)
                    <h4>{{__('You are requested to verify your account on')}} {{$vreq->created_at->diffForHumans()}}
                        {{__(', Your status is')}}
                        @if ($vreq->status == 0)
                        {{('Rquested.')}}
                        @elseif($vreq->status == 1)
                        {{('Approved.')}}
                        @else
                        {{('Rejected.')}}
                        @endif
                    </h4>
                    <p>{{__('For more details please contact admin.')}}</p>
                    @else
                    <h4>{{__('Verify Your ID')}}</h4>
                    <form action="{{route('verification.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="ui search focus mt-50 lbel25">
                            <label>{{__('Your Name')}}*</label>
                            <div class="ui left icon input swdh19">
                                <input class="prompt srch_explore" type="text" placeholder="{{__('Full Name')}}"
                                    name="name" maxlength="60" value="{{auth()->user()->name}}">
                            </div>
                            @error('name')
                            <x-invalid-feedback> {{ $message }}
                            </x-invalid-feedback>
                            @enderror
                        </div>
                        <div class="part_input mt-30 lbel25">
                            <label>{{__('Upload Document*')}}</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile06" name="document">
                                    <label class="custom-file-label" for="inputGroupFile06">{{__('No Choose')}}</label>
                                </div>
                                @error('document')
                                <x-invalid-feedback> {{ $message }}
                                </x-invalid-feedback>
                                @enderror
                            </div>
                        </div>
                        <button class="verify_submit_btn" type="submit">{{__('Submit Now')}}</button>
                    </form>
                    @endif


            </div>
        </div>
    </div>
</div>
@endsection