@extends('frontend.layouts.ins-master')

@push('styles')


@endpush
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2 class="st_title"><i class='uil uil-cog'></i> {{__('Setting')}}</h2>
        <div class="setting_tabs">
            <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{!$errors->any() ? 'active' : ''}}" id="pills-account-tab" data-toggle="pill"
                        href="#pills-account" role="tab"
                        aria-selected="{{ !$errors->any() ? 'true' : 'false'}}">{{__('Account')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-notification-tab" data-toggle="pill" href="#pills-notification"
                        role="tab" aria-selected="false">{{__('Notification')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @error('password')  active @enderror" id="pills-privacy-tab" data-toggle="pill"
                        href="#pills-privacy" role="tab"
                        aria-selected="{{ old('password') ? 'true' : 'false'}}">{{__('Password')}}</a>
                </li>

               
            </ul>
        </div>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade @if (!$errors->any()) show active @endif " id="pills-account" role="tabpanel"
                aria-labelledby="pills-account-tab">
                <div class="account_setting">
                    <form method="post" action="{{ route('profile.updatestu') }}" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <h4>{{__('Your')}} {{env('APP_NAME')}} {{__('Account')}}</h4>
                        <p>{{__('This is your public presence on')}} {{env('APP_NAME')}}. {{__('You need a account to upload your paid courses,
                            comment
                            on
                            courses, purchased by students, or earning.')}}</p>
                        <div class="basic_profile">
                            <div class="basic_ptitle">
                                <h4>{{__('Basic Profile')}}</h4>
                                <p>{{__('Add information about yourself')}}</p>
                            </div>
                            <div class="basic_form">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="ui search focus mt-30">
                                                    <div class="ui left  input swdh11 swdh19">
                                                        <input class="prompt srch_explore" type="text" name="name"
                                                            value="{{auth()->user()->name}}" required maxlength="64"
                                                            placeholder="{{__('Your Name')}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="ui search focus mt-30">
                                                    <div class="ui left  input swdh11 swdh19">
                                                        <input class="prompt srch_explore" type="text" name="email"
                                                            value="{{auth()->user()->email}}" required="" maxlength="64"
                                                            placeholder="{{__('Email')}}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="part_input mt-30 lbel25">
                                                    <label>{{__('Profile picture *')}}</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                id="lectureFileInput" name="image" accept="image/png">
                                                            <label class="custom-file-label"
                                                                for="inputGroupFile06">{{__('No Choose file ')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="divider-1"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="save_btn" type="submit">{{__('Save Changes')}}</button>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-notification" role="tabpanel" aria-labelledby="pills-notification-tab">
                <div class="account_setting">
                    <form method="post" action="{{ route('profile.updatestu') }}" autocomplete="off">
                        @csrf
                        @method('put')
                        <h4>{{__('Notifications - Choose when and how to be notified')}}</h4>
                        <p>{{__('Select push and email notifications you`d like to receive')}}</p>
                        <div class="basic_profile">
                            <div class="basic_form">
                                <div class="nstting_content">
                                    <div class="basic_ptitle">
                                        <h4>{{__('Choose when and how to be notified')}}</h4>
                                    </div>
                                    <div class="ui toggle checkbox _1457s2">
                                        <input type="checkbox" name="push_notification" value="1"
                                            {{auth()->user()->push_notification == 1 ? ' checked' : ''}}>
                                    <label>{{__('In-App notifications')}}</label>
                                    <p class="ml5">{{__('Notify me with push notifications')}}</p>
                                </div>

                            </div>
                        </div>
                </div>
                <div class="divider-1 mb-50"></div>
                <div class="basic_profile">
                    <div class="basic_form">
                        <div class="nstting_content">
                            <div class="basic_ptitle">
                                <h4>{{__('Email notifications')}}</h4>
                                <p>{{__('Select push and email notifications you`d like to receive')}}</p>
                            </div>
                            <div class="ui toggle checkbox _1457s2">
                                <input type="checkbox" name="email_notification" value="1"
                                    {{auth()->user()->email_notification == 1 ? ' checked' : ''}}>
                                <label>{{__('Email notifications')}}</label>
                                <p class="ml5">{{__('Notify me with Email')}}</p>
                            </div>

                        </div>
                    </div>
                </div>
                <button class="save_btn" type="submit">{{__('Save Changes')}}</button>
                </form>
            </div>
        </div>
        <div class="tab-pane fade @error('password') show active @enderror" id="pills-privacy" role="tabpanel"
            aria-labelledby="pills-privacy-tab">
            <form method="post" action="{{ route('profile.passwordstu') }}" autocomplete="off">
                @csrf
                @method('put')
                <div class="account_setting">

                    <h4>{{__('Password Update')}}</h4>
                    <p>{{__('Modify your password here.')}}</p>
                    <div class="basic_profile">
                        <div class="basic_form">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="ui search focus mt-30">
                                                <div class="ui left  input swdh11 swdh19">
                                                    <input class="prompt srch_explore" type="password"
                                                        name="old_password" required maxlength="64" minlength="6"
                                                        placeholder="{{__('Your old password')}}">
                                                </div>
                                            </div>
                                            @error('old_password')
                                            <div class="help-block">
                                                <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="ui search focus mt-30">
                                                <div class="ui left  input swdh11 swdh19">
                                                    <input class="prompt srch_explore" type="password" name="password"
                                                        required="" maxlength="64" minlength="6"
                                                        placeholder="{{__('New Password')}}">
                                                </div>
                                            </div>
                                            @error('password')
                                            <div class="help-block">
                                                <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="ui search focus mt-30">
                                                <div class="ui left icon input swdh11 swdh19">
                                                    <input class="prompt srch_explore" type="text"
                                                        name="password_confirmation" required="" maxlength="60"
                                                        minlength="6" placeholder="{{__('Confirm your password')}}">

                                                </div>
                                            </div>
                                            @error('password_confirmation')
                                            <div class="help-block">
                                                <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="save_btn" type="submit">Save Changes</button>
            </form>
        </div>
        <div class="tab-pane fade" id="pills-closeaccount" role="tabpanel" aria-labelledby="pills-closeaccount-tab">
            <div class="account_setting">
                <h4>Close account</h4>
                <p><strong>Warning:</strong> If you close your account, you will be unsubscribed from all your 5
                    courses, and will lose access forever.</p>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="ui search focus mt-30">
                        <div class="ui left icon input swdh11 swdh19">
                            <input class="prompt srch_explore" type="password" name="yourassword" id="id_yourpassword"
                                required="" maxlength="64" placeholder="Enter Your Password">
                        </div>
                        <div class="help-block">Are you sure you want to close your account?</div>
                    </div>
                    <button class="save_payout_btn mbs20" type="submit">Close Account</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection