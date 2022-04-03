@extends('frontend.layouts.ins-master')
@section('content')
<style>
    .panel-body {
        background: transparent;
        border: none;
    }
</style>
<div class="sa4d25 mb4d25">
    <div class="">
        <div class="row justify-content-between">
            <div class="col-lg-3 col-md-4">
                <form method="GET" id="srform">
                    <input type="hidden" name="sort" value="{{$params['sort']}}" id="sort">
                    <div class="section3125 hstry142">
                        <div class="result_stitles">
                            <div class="rs6t_title">{{__('Filters')}}</div>
                            <div class="filter_selector">
                                <div class="ui inline dropdown flt145">
                                    <div class="text">{{__('Sort')}}</div>
                                    <i class="dropdown icon"></i>
                                    <div class="menu">
                                        <div class="item" onclick="sortChange(1)">{{__('Newest')}}</div>
                                        <div class="item" onclick="sortChange(2)">{{__('Lowest Price')}}</div>
                                        <div class="item" onclick="sortChange(3)">{{__('Highest Price')}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tb_145">
                            <div class="panel-group accordion" id="accordionfilter">
                                <div class="panel panel-default m-0">
                                    <div class="panel-heading" id="headingOne">
                                        <div class="panel-title10">
                                            <a class="collapsed" data-toggle="collapse" data-target="#collapseOne"
                                                href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                {{__('Topic')}}
                                            </a>
                                        </div>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse" aria-labelledby="headingOne"
                                        data-parent="#accordionfilter">
                                        <div class="panel-body">
                                            <div class="ui form">
                                                <div class="grouped fields">
                                                    @foreach ($category as $cat)

                                                    <div class="ui form checkbox_sign">
                                                        <div class="inline field">
                                                            <div class="ui checkbox mncheck">
                                                                <input type="radio" tabindex="0" class="hidden"
                                                                    name="category" value="{{$cat->id}}"
                                                                    {{$params['category'] ==$cat->id ? 'checked' : ''}}>
                                                                <label>{{$cat->name}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default m-0">
                                    <div class="panel-heading" id="headingThree">
                                        <div class="panel-title10">
                                            <a class="collapsed" data-toggle="collapse" data-target="#collapseThree"
                                                href="#" aria-expanded="false" aria-controls="collapseThree">
                                                {{__('Language')}}
                                            </a>
                                        </div>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse"
                                        aria-labelledby="headingThree" data-parent="#accordionfilter">
                                        <div class="panel-body">
                                            <div class="ui form">
                                                <div class="grouped fields">
                                                    @foreach ($language as $lan)
                                                    <div class="ui form checkbox_sign">
                                                        <div class="inline field">
                                                            <div class="ui checkbox mncheck">
                                                                <input type="radio" name="language" tabindex="0"
                                                                    class="hidden" value="{{$lan->id}}"
                                                                    {{$params['language'] == $lan->id ? 'checked' : ''}}>
                                                                <label>{{$lan->name}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default m-0">
                                    <div class="panel-heading" id="headingfour">
                                        <div class="panel-title10">
                                            <a class="collapsed" data-toggle="collapse" data-target="#collapsefour"
                                                href="#" aria-expanded="false" aria-controls="collapsefour">
                                                {{__('Price')}}
                                            </a>
                                        </div>
                                    </div>
                                    <div id="collapsefour" class="panel-collapse collapse" aria-labelledby="headingfour"
                                        data-parent="#accordionfilter">
                                        <div class="panel-body">
                                            <div class="ui form">
                                                <div class="grouped fields">
                                                    <div class="ui form checkbox_sign">
                                                        <div class="inline field">
                                                            <div class="ui checkbox mncheck">
                                                                <input type="radio" name="price" value="1" tabindex="0"
                                                                    class="hidden"
                                                                    {{$params['price'] == 1 ? 'checked' : ''}}>
                                                                <label>{{__('Paid')}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ui form checkbox_sign">
                                                        <div class="inline field">
                                                            <div class="ui checkbox mncheck">
                                                                <input type="radio" name="price" value="0" tabindex="0"
                                                                    class="hidden"
                                                                    {{$params['price'] == 0 ? 'checked' : ''}}>
                                                                <label>{{__('Free')}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default m-0">
                                    <div class="panel-heading" id="headingsix">
                                        <div class="panel-title10">
                                            <a class="collapsed" data-toggle="collapse" data-target="#collapsesix"
                                                href="#" aria-expanded="false" aria-controls="collapsesix">
                                                {{__('Rating')}}
                                            </a>
                                        </div>
                                    </div>
                                    <div id="collapsesix" class="panel-collapse collapse" aria-labelledby="headingsix"
                                        data-parent="#accordionfilter">
                                        <div class="panel-body">
                                            <div class="ui form">
                                                <div class="grouped fields">
                                                    <div class="ui form checkbox_sign">
                                                        <div class="inline field">
                                                            <div class="ui checkbox mncheck">
                                                                <input type="radio" name="rating" value="5" tabindex="0"
                                                                    class="hidden"
                                                                    {{$params['rating'] == 5 ? 'checked' : ''}}>
                                                                <label class="rating_filter">
                                                                    <i class="uil uil-star"></i>
                                                                    <i class="uil uil-star"></i>
                                                                    <i class="uil uil-star"></i>
                                                                    <i class="uil uil-star"></i>
                                                                    <i class="uil uil-star"></i>
                                                                    5.0 &amp; {{__('up')}}

                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="inline field">
                                                            <div class="ui checkbox mncheck">
                                                                <input type="radio" name="rating" value="4" tabindex="0"
                                                                    class="hidden"
                                                                    {{$params['rating'] == 4 ? 'checked' : ''}}>
                                                                <label class="rating_filter">
                                                                    <i class="uil uil-star"></i>
                                                                    <i class="uil uil-star"></i>
                                                                    <i class="uil uil-star"></i>
                                                                    <i class="uil uil-star"></i>
                                                                    4.0 &amp; {{__('up')}}

                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="inline field">
                                                            <div class="ui checkbox mncheck">
                                                                <input type="radio" name="rating" value="3" tabindex="0"
                                                                    class="hidden"
                                                                    {{$params['rating'] == 3 ? 'checked' : ''}}>
                                                                <label class="rating_filter">
                                                                    <i class="uil uil-star"></i>
                                                                    <i class="uil uil-star"></i>
                                                                    <i class="uil uil-star"></i>
                                                                    3.0 &amp; {{__('up')}}

                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="inline field">
                                                            <div class="ui checkbox mncheck">
                                                                <input type="radio" name="rating" value="2" tabindex="0"
                                                                    class="hidden"
                                                                    {{$params['rating'] == 2 ? 'checked' : ''}}>
                                                                <label class="rating_filter">
                                                                    <i class="uil uil-star"></i>
                                                                    <i class="uil uil-star"></i>
                                                                    2.0 &amp; {{__('up')}}

                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default m-0">
                                    <div class="panel-heading" id="headingseven">
                                        <div class="panel-title10">
                                            <a class="collapsed" data-toggle="collapse" data-target="#collapseseven"
                                                href="#" aria-expanded="false" aria-controls="collapseseven">
                                                {{__('Video Duration')}}
                                            </a>
                                        </div>
                                    </div>
                                    <div id="collapseseven" class="panel-collapse collapse"
                                        aria-labelledby="headingseven" data-parent="#accordionfilter">
                                        <div class="panel-body">
                                            <div class="ui form">
                                                <div class="grouped fields">
                                                    <div class="ui form checkbox_sign">
                                                        <div class="inline field">
                                                            <div class="ui checkbox mncheck">
                                                                <input type="radio" name="duration" value="0-120"
                                                                    tabindex="0" class="hidden"
                                                                    {{$params['duration'] == '0-120' ? 'checked' : ''}}>
                                                                <label>{{__('0-2 Hours')}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ui form checkbox_sign">
                                                        <div class="inline field">
                                                            <div class="ui checkbox mncheck">
                                                                <input type="radio" name="duration" value="180-360"
                                                                    tabindex="0" class="hidden"
                                                                    {{$params['duration'] == '180-360' ? 'checked' : ''}}>
                                                                <label>{{__('3-6 Hours')}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ui form checkbox_sign">
                                                        <div class="inline field">
                                                            <div class="ui checkbox mncheck">
                                                                <input type="radio" name="duration" value="420-1080"
                                                                    tabindex="0" class="hidden"
                                                                    {{$params['duration'] == '420-1080' ? 'checked' : ''}}>
                                                                <label>{{__('7-18 Hours')}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ui form checkbox_sign">
                                                        <div class="inline field">
                                                            <div class="ui checkbox mncheck">
                                                                <input type="radio" name="duration" value="1140-9999"
                                                                    tabindex="0" class="hidden"
                                                                    {{$params['duration'] == '1140-9999' ? 'checked' : ''}}>
                                                                <label>{{__('19+ Hours')}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                </form>
            </div>
            <div class="col-lg-9 col-md-8">
                <div class="_14d25 mb-20">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="mhs_title">{{__('Filters Results')}} <span class="float-right cu"
                                    onclick="document.getElementById('srform').submit()" role="button">{{__('Search')}}</span>
                            </h4>

                            <div class="row">
                                @forelse ($courses as $course)
                                <div class="col-xl-4 col-lg-6 col-md-6">
                                    <x-horizontal-courses :course="$course"></x-horizontal-courses>
                                </div>
                               
                                @empty
                                <div class="col-md-12 text-center">
                                    <x-nodata></x-nodata>
                                </div>
                                @endforelse
                            </div>

                        </div>
                        <div class="col-md-12 text-center">
                            <div class="main-loader mt-50">
                                {{$courses->appends($params)->links("vendor.pagination.semantic-ui") }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    "use strict";
    function sortChange(sort){
        document.getElementById("sort").value = sort
    }
</script>
@endsection
