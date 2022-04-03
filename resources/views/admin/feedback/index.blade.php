@extends('layouts.admin-master')

@section('title')
{{ __('Feedback') }}
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{ __('Feedback') }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">{{ __('Home') }}</a></div>
            <div class="breadcrumb-item"><a href="#">{{ __('Feedback') }}</a></div>
        </div>
    </div>

    <div class="section-body">
        <x-alert-msg></x-alert-msg>
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header d-felx justify-content-between">
                        <h4>{{ __('Feedback List') }}</h4>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped  no-footer">
                                <thead>
                                    <tr>
                                        <th>
                                            {{__(' #')}}
                                        </th>
                                        <th>
                                            {{__('Name')}}
                                        </th>
                                        <th>
                                            {{__('Email')}}
                                        </th>
                                        </th>
                                        <th>
                                            {{__('Message')}}
                                        </th>
                                        <th>
                                            {{__('File')}}
                                        </th>
                                        <th>
                                            {{__('Date')}}
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($feedback as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td> {{ $item->name}} </td>
                                        <td> <a href="mailto:{{$item->email}}"> {{ $item->email }} </a></td>
                                        <td> {{ $item->msg}} </td>
                                        <td> <a href="{{ asset($item->document) }}" target="_blank">
                                                {{__('View Document')}} </a></td>


                                        <td>{{$item->created_at->diffForHumans()}}</td>


                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection