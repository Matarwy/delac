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
            <div class="breadcrumb-item"><a href="#">{{ __('General') }}</a></div>
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
                            <h4>{{__('Email Setting')}}</h4>

                        </div>
                        <div class="card-body ">
                            <form method="post">
                                <div class="row">
                                    <div class="col-12 ">
                                        <div class="form-group">
                                            <label>{{ __('MAIL_MAILER') }}</label>
                                            <select name="MAIL_MAILER" class="form-control select2-dd" required>
                                                <option value="smtp"
                                                    {{ env("MAIL_MAILER") == "smtp" ? 'selected' : '' }}>
                                                    smtp</option>
                                                <option value="mailgun"
                                                    {{ env("MAIL_MAILER") == "mailgun" ? 'selected' : '' }}>
                                                    mailgun</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('MAIL_HOST') }}</label>
                                            <input type="text" name="MAIL_HOST" class="form-control"
                                                value="{{ env("MAIL_HOST") }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('MAIL_PORT') }}</label>
                                            <input type="text" name="MAIL_PORT" class="form-control"
                                                value="{{ env("MAIL_PORT") }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('MAIL_USERNAME') }}</label>
                                            <input type="text" name="MAIL_USERNAME" class="form-control"
                                                value="{{ env("MAIL_USERNAME") }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('MAIL_PASSWORD') }}</label>
                                            <input type="text" name="MAIL_PASSWORD" class="form-control"
                                                value="{{ env("MAIL_PASSWORD") }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('MAIL_ENCRYPTION') }}</label>
                                            <input type="text" name="MAIL_ENCRYPTION" class="form-control"
                                                value="{{ env("MAIL_ENCRYPTION") }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('MAIL_FROM_ADDRESS') }}</label>
                                            <input type="text" name="MAIL_FROM_ADDRESS" class="form-control"
                                                value="{{ env("MAIL_FROM_ADDRESS") }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('MAILGUN_DOMAIN') }}</label>
                                            <input type="text" name="MAILGUN_DOMAIN" class="form-control"
                                                value="{{ env("MAILGUN_DOMAIN") }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('MAILGUN_SECRET') }}</label>
                                            <input type="text" name="MAILGUN_SECRET" class="form-control"
                                                value="{{ env("MAILGUN_SECRET") }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('MAILGUN_ENDPOINT') }}</label>
                                            <input type="text" name="MAILGUN_ENDPOINT" class="form-control"
                                                value="{{ env("MAILGUN_ENDPOINT") }}">
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