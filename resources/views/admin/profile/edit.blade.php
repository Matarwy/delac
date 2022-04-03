@extends('layouts.admin-master')

@section('title')
{{ __('User Profile') }}
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{ __('User Profile') }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">{{ __('Home') }}</a></div>
            <div class="breadcrumb-item"><a href="#">{{ __('User Profile') }}</a></div>
        </div>
    </div>

    <div class="section-body">
        <x-alert-msg></x-alert-msg>
        <div class="row">

            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                <div class="card">
                    <div class="card-header">
                        <h4>{{__('Update Password')}}</h4>
                    </div>

                    <div class="card-body">
                        <form method="post" action="{{ route('profile.adpassword') }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                <label class="form-control-label"
                                    for="input-current-password">{{ __('Current Password') }}</label>
                                <input type="password" name="old_password" id="input-current-password"
                                    class="form-control form-control-alternative{{ $errors->has('old_password') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Current Password') }}" value="" required>

                                @error('old_password')
                                <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                                @enderror
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-password">{{ __('New Password') }}</label>
                                <input type="password" name="password" id="input-password"
                                    class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('New Password') }}" value="" required>

                                @error('password')
                                <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label"
                                    for="input-password-confirmation">{{ __('Confirm New Password') }}</label>
                                <input type="password" name="password_confirmation" id="input-password-confirmation"
                                    class="form-control form-control-alternative"
                                    placeholder="{{ __('Confirm New Password') }}" value="" required>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">{{ __('Change password') }}</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <h4>{{__('Edit Profile')}}</h4>
                    </div>

                    <div class="card-body">
                        <form method="post" action="{{ route('profile.adupdate') }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                <input type="text" name="name" id="input-name"
                                    class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}"
                                    required autofocus>

                                @error('name')
                                <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                                @enderror
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                <input type="email" name="email" id="input-email"
                                    class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}"
                                    required>
                                @error('permissions')
                                <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                                @enderror
                            </div>
                            <div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">{{ __('Image') }}</label>
                                <input type="file" accept="image/png" name="image" id="input-name"
                                    class="form-control form-control-alternative{{ $errors->has('image') ? ' is-invalid' : '' }}">

                                @error('image')
                                <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                                @enderror
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary ">{{ __('Save') }}</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection