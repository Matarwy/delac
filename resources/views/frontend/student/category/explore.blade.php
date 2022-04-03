@extends('frontend.layouts.ins-master')
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-8">
        <div class="section3125">
            <div class="explore_search">
                <div class="ui search focus">
                    <form action="{{ route('explore') }}" method="post">
                        @csrf
                        <div class="ui left icon input swdh11">
                            <input class="prompt srch_explore" type="text" placeholder="{{__('Search Courses...')}}"
                                name="q" value="{{$params['q']}}">
                            <i class="uil uil-search-alt icon icon2"></i>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="section3125 mb-15 mt-50">
            <h4 class="item_title">{{__('Live Streams')}}</h4>
            <a href="{{ route('live.index') }}" class="see150">{{__('See all')}}</a>
            <div class="la5lo1">
                <div class="owl-carousel live_stream owl-theme">
                    @foreach ($streams as $stream)
                    <x-live-stream :stream="$stream"></x-live-stream>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="_14d25">
            <div class="row mt-30">
                <div class="col-12"><h4 class="item_title">{{__('Courses')}}</h4></div>
                @forelse ($courses as $course)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <x-horizontal-courses :course="$course"></x-horizontal-courses>
                </div>
                @empty
                <div class="col-md-12 text-center">
                    <x-nodata></x-nodata>
                </div>
                @endforelse

                <div class="col-md-12 text-center">
                    <div class="main-loader mt-50">
                        {{$courses->appends($params)->links("vendor.pagination.semantic-ui") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection