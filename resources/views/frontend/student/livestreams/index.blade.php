@extends('frontend.layouts.ins-master')
@section('content')
<div class="row">
    <div class="col-xl-9 col-lg-8">
        <div class="section3125">
            <h4 class="item_title">All Live Streams</h4>
            <div class="la5lo1">
                <div class="row">
                    @forelse ($instructors as $stream)

                    <div class="col-md-3 mb-30">
                        <x-live-stream :stream="$stream"></x-live-stream>
                    </div>
                
                    @empty
                    <div class="col-md-12 text-center">
                        <x-nodata></x-nodata>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>




    <div class="col-xl-3 col-lg-4">
        <div class="right_side">
            <div class="fcrse_3">
                <div class="cater_ttle">
                    <h4>{{__('Live Streaming')}}</h4>
                </div>
                <div class="live_text">
                    <div class="live_icon"><i class="uil uil-kayak"></i></div>
                    <div class="live-content">
                        <p>{{__('Set up your channel and stream live to your students')}}</p>
                        <button class="live_link" onclick="window.location.href = '{{url('instructor/login')}}';">{{__('Get
                            Started')}}</button>
                        <span class="livinfo">{{__('Info : This feature only for Instructors.')}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection