@extends('frontend.layouts.ins-master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2 class="st_title"><i class="uil uil-comment-info-alt"></i> {{__('Send Feedback')}}</h2>
        @if (request()->is('feedback'))

        <form action="{{url("feedback")}}" method="post" enctype="multipart/form-data">
            @else
            <form action="{{url("instructor/feedback")}}" method="post" enctype="multipart/form-data">

                @endif
                @csrf
                <div class="row mt-5">
                    <div class="col-lg-6 col-md-8">
                        <div class="ui search focus">
                            <div class="ui left icon input swdh11 swdh19">
                                <input class="prompt srch_explore" type="text" name="name" required="" maxlength="64"
                                    placeholder="{{('Full Name')}}" minlength="1">
                                <i class="uil uil-user icon icon2"></i>

                            </div>
                            @error('name')
                            <x-invalid-feedback> {{ $message }}
                            </x-invalid-feedback>
                            @enderror
                        </div>
                        <div class="ui search focus mt-30">
                            <div class="ui left icon input swdh11 swdh19">
                                <input class="prompt srch_explore" type="email" name="email" required="" maxlength="64"
                                    placeholder="{{__('Email address')}}">
                                <i class="uil uil-envelope icon icon2"></i>

                            </div>
                            @error('email')
                            <x-invalid-feedback> {{ $message }}
                            </x-invalid-feedback>
                            @enderror
                        </div>
                        <div class="ui search focus mt-30">
                            <div class="ui form swdh30">
                                <div class="field">
                                    <textarea rows="6" name="msg"
                                        placeholder="{{__('Describe your issue or share your ideas')}}"
                                        required></textarea>
                                </div>
                                @error('msg')
                                <x-invalid-feedback> {{ $message }}
                                </x-invalid-feedback>
                                @enderror
                            </div>
                        </div>
                        <div class="part_input mt-30 lbel25">
                            <label>{{__('Upload Document*')}}</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile06" name="document">
                                    <label class="custom-file-label" for="inputGroupFile06">{{__('No Choose')}}</label>

                                </div>

                            </div>
                            @error('document')
                            <x-invalid-feedback> {{ $message }}
                            </x-invalid-feedback>
                            @enderror
                        </div>
                        <button class="save_btn" type="submit">{{__('Send Feedback')}}</button>
                    </div>
                </div>
            </form>
    </div>
</div>
@endsection