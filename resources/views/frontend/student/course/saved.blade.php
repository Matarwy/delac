@extends('frontend.layouts.ins-master')
@section('content')
<div class="row">
    <div class="col-lg-3 col-md-4 ">
        <div class="section3125 hstry142">
            <div class="grp_titles pt-0">
                <div class="ht_title">{{__('Saved Courses')}}</div>
                <a href="{{ route('saved-course-delete') }}" class="ht_clr">{{__('Remove All')}}</a>
            </div>
            <div class="tb_145">
                <div class="wtch125">
                    <span class="vdt14">{{count($courses)}} {{__('Courses')}}</span>
                </div>
                <a href="{{ route('saved-course-delete') }}" class="rmv-btn"><i
                        class='uil uil-trash-alt'></i>{{__('Remove Saved Courses')}}</a>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="_14d25 mb-20">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="mhs_title">{{__('Saved Courses')}}</h4>
                    @forelse ($courses as $course)
                    <x-vertical-coures :course="$course"></x-vertical-coures>


                    @empty
<x-nodata></x-nodata>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection