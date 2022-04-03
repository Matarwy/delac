@extends('frontend.layouts.ins-master')
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-8">
        <div class="section3125">
            <div class="explore_search">
                <div class="ui search focus">
                    <form action="{{ route('instructorAll') }}" method="post">
                        @csrf
                        <div class="ui left icon input swdh11">
                            <input class="prompt srch_explore" type="text" placeholder="{{__('Search Tutors...')}}"
                                name="q" value="{{$params['q']}}">
                            <i class="uil uil-search-alt icon icon2"></i>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="_14d25">
            <div class="row mt-30">
              

                @forelse ($instructors as $item)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <x-sqaure-instructors :ins="$item"></x-sqaure-instructors>
                </div>
                @empty
                <div class="col-md-12 text-center">
                <x-nodata></x-nodata>
                </div>
                @endforelse

                <div class="col-md-12 text-center">
                    <div class="main-loader mt-50">
                        {{$instructors->appends($params)->links("vendor.pagination.semantic-ui") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection