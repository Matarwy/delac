@extends('frontend.layouts.ins-master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2 class="st_title"><i class="uil uil-analysis"></i> {{__('Analytics')}}</h2>
    </div>
</div>
<div class="row">
    <div class="col-xl-4 col-sm-6">
        <div class="card card-mini analysis_card">
            <div class="card-body">
                <h2 class="mb-2">{{ array_sum($master['subscriber'])}}</h2>
                <p>{{__('Subscribers')}}</p>
                <div class="chartjs-wrapper">
                    <canvas id="barChart" data-chat={!!json_encode($master['subscriber'])!!}
                        data-month={!!json_encode($master['months'])!!}></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-sm-6">
        <div class="card card-mini analysis_card">
            <div class="card-body">
                <h2 class="mb-1">{{ array_sum($master['w_earning'])}}</h2>
                <p>{{__('Weekly Earning')}}</p>
                <div class="chartjs-wrapper">
                    <canvas id="dual-line" data-chat={!!json_encode($master['w_earning'])!!}
                        data-lable={!!json_encode($master['days'])!!}></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-sm-6">
        <div class="card card-mini analysis_card">
            <div class="card-body">
                <h2 class="mb-1">{{ array_sum($master['w_sell'])}}</h2>
                <p>{{__('Weekly Sales')}}</p>
                <div class="chartjs-wrapper">
                    <canvas id="line" data-chat={!!json_encode($master['w_sell'])!!}
                        data-lable={!!json_encode($master['days'])!!}></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="card card-default analysis_card p-0" data-scroll-height="450">
            <div class="card-header">
                <h2>{{__('Sales Of The Year')}}</h2>
            </div>
            <div class="card-body p-5 linechart" >
                <canvas id="linechart" class="chartjs" data-chat={!!json_encode($master['y_earning'])!!}
                        data-lable={!!json_encode($master['months'])!!}></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="table-responsive mt-30">
            <table class="table ucp-table">
                <thead class="thead-s">
                    <tr>
                        <th class="text-center" scope="col">{{__('Item No.')}}</th>
                        <th class="cell-ta" scope="col">{{__('Thumbnail')}}</th>
                        <th class="cell-ta" scope="col">{{__('Title')}}</th>
                        <th class="text-center" scope="col">{{__('Purchases')}}</th>
                        <th class="text-center" scope="col">{{__('Comments')}}</th>
                        <th class="text-center" scope="col">{{__('Views')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($master['course'] as $item)

                    <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td class="cell-ta">
                            <div class="thumb_img"><img src="{{ asset($item->cover_image) }}" alt=""></div>
                        </td>
                        <td class="cell-ta">{{$item->title}}</td>
                        <td class="text-center">{{$item->enroll_count}}</td>
                        <td class="text-center">{{$item->enroll_count}}</td>
                        <td class="text-center">{{$item->views}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('frontend/js/Chart.min.js')}}"></script>
<script src="{{ asset('frontend/js/chart.js')}}"></script>
@endpush