@extends('layouts.admin-master')

@section('title')
{{ __('Dashboard') }}
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{ __('Dashboard') }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">{{ __('Home') }}</a></div>
            <div class="breadcrumb-item"><a href="#">{{ __('Dashboard') }}</a></div>
            <div class="breadcrumb-item">{{ __('Dashboard') }}</div>
        </div>
    </div>

    <div class="section-body">
        <x-alert-msg></x-alert-msg>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{__('Total Admin')}}</h4>
                        </div>
                        <div class="card-body">
                            {{ number_format($master['tot_admin'])}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-dark">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{__('Total Instructor')}}</h4>
                        </div>
                        <div class="card-body">
                            {{ number_format($master['tot_ins'])}}

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{__('Total Student')}}</h4>
                        </div>
                        <div class="card-body">
                            {{ number_format($master['tot_stu'])}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{__('Statistics')}}</h4>
                    </div>
                    <div class="card-body chart-body">
                        <canvas id="myChart2" data-earning={{json_encode($master['earning'])}}
                            data-month={{json_encode($master['months'])}}
                            data-commission={{json_encode($master['commission'])}}></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card card-statistic-2">

                    <div class="card-icon shadow-info bg-info">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{__('Course')}}</h4>
                        </div>
                        <div class="card-body">
                            {{ number_format($master['tot_course'])}}

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card card-statistic-2">

                    <div class="card-icon shadow-warning bg-warning">
                        <i class="far fa-hand-spock"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{__('waiting For Approval')}}</h4>
                        </div>
                        <div class="card-body">
                            {{ number_format($master['waiting'])}}

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card card-statistic-2">

                    <div class="card-icon shadow-dark bg-dark">
                        <i class="fas fa-ban"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{__('Block')}}</h4>
                        </div>
                        <div class="card-body">
                            {{ number_format($master['block'])}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card card-statistic-2">

                    <div class="card-icon shadow-primary bg-primary">
                        <i class="far fa-trash-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{__('Rejected')}}</h4>
                        </div>
                        <div class="card-body">
                            {{ number_format($master['rejected'])}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card gradient-bottom">
                    <div class="card-header">
                        <h4>{{__('Top 5 Courses')}}</h4>

                    </div>
                    <div class="card-body courses-5" id="top-5-scroll" tabindex="2">
                        <ul class="list-unstyled list-unstyled-border">
                            @foreach ($master['toppro'] as $item)

                            <li class="media">
                                <img class="mr-3 rounded" width="55"
                                    src="{{ asset($item->course->cover_image ?? 'No Data') }}" alt="product">
                                <div class="media-body">
                                    <div class="float-right">
                                        <div class="font-weight-600 text-muted text-small">{{$item->total}}
                                            {{__('Sales')}}</div>
                                    </div>
                                    <div class="media-title">{{$item->course->title ?? "No Data"}}</div>
                                    <div class="mt-1">
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-primary w-64" data-width="64%">
                                            </div>
                                            <div class="budget-price-label">
                                                {{$admin_setting[7]['value']}}{{$item->earning}}</div>
                                        </div>
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-success w-43" data-width="43%" >
                                            </div>
                                            <div class="budget-price-label">{{$admin_setting[7]['value']}}{{$item->ac}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="card-footer pt-3 d-flex justify-content-center">
                        <div class="budget-price justify-content-center">
                            <div class="budget-price-square bg-primary w-20" data-width="20" ></div>
                            <div class="budget-price-label">{{__('Instructor Earning')}}</div>
                        </div>
                        <div class="budget-price justify-content-center">
                            <div class="budget-price-square bg-success w-20" data-width="20" ></div>
                            <div class="budget-price-label">{{__('Admin Commission')}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card gradient-bottom">
                    <div class="card-header">
                        <h4>{{__('Top 5 Instructor')}}</h4>

                    </div>
                    <div class="card-body courses-5" id="top-4-scroll" tabindex="2">
                        <ul class="list-unstyled list-unstyled-border">
                            @foreach ($master['topins'] as $item)

                            <li class="media">
                                <img class="mr-3 rounded" width="55"
                                    src="{{ asset($item->instructor->image ?? 'No Data') }}" alt="product">
                                <div class="media-body">
                                    <div class="float-right">
                                        <div class="font-weight-600 text-muted text-small">{{$item->total}}
                                            {{__('Sales')}}</div>
                                    </div>
                                    <div class="media-title">{{$item->instructor->name ?? "No Data"}}</div>
                                    <div class="mt-1">
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-primary w-64" data-width="64%"
                                                >
                                            </div>
                                            <div class="budget-price-label">
                                                {{$admin_setting[7]['value']}}{{$item->earning}}</div>
                                        </div>
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-success w-43" data-width="43%"
                                                >
                                            </div>
                                            <div class="budget-price-label">{{$admin_setting[7]['value']}}{{$item->ac}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="card-footer pt-3 d-flex justify-content-center">
                        <div class="budget-price justify-content-center">
                            <div class="budget-price-square bg-primary w-20" data-width="20"></div>
                            <div class="budget-price-label">{{__('Instructor Earning')}}</div>
                        </div>
                        <div class="budget-price justify-content-center">
                            <div class="budget-price-square bg-success w-20" data-width="20"></div>
                            <div class="budget-price-label">{{__('Admin Commission')}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fa fa-language"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{__('Languages')}}</h4>
                        </div>
                        <div class="card-body">
                            {{ number_format($master['lang'])}}

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-light">
                        <i class="fas fa-list-ul"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{__('Category')}}</h4>
                        </div>
                        <div class="card-body">
                            {{ number_format($master['cat'])}}

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{__('Sub Category')}}</h4>
                        </div>
                        <div class="card-body">
                            {{ number_format($master['sub_cat'])}}

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>
@endsection