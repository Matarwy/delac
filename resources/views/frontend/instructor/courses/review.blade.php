@extends('frontend.layouts.ins-master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2 class="st_title"><i class="uil uil-star"></i> {{__('All Review')}}</h2>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="student_reviews">
            <div class="row">
                <div class="col-lg-5">
                    <div class="reviews_left">
                        <h3>{{__('All Student Feedback')}}</h3>
                        <div class="total_rating">
                            <div class="_rate001">{{$state['avg_rating']}}</div>
                            <div class="rating-box">

                                @for ($i = 0; $i < 5;$i++) <span
                                    class="rating-star {{$state['avg_rating'] > $i ? 'full-star' : 'empty-star'}}">
                                    </span>
                                    @endfor
                            </div>
                            <div class="_rate002">{{__('All Rating')}}</div>
                        </div>
                        <div class="_rate003">
                            <div class="_rate004">
                                <div class="progress progress1">
                                    <div class="progress-bar " role="progressbar" aria-valuenow="{{$state['5_star']}}"
                                        aria-valuemin="0" aria-valuemax="100" style="width:{{$state['5_star']}}%">
                                    </div>
                                </div>
                                <div class="rating-box">
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star full-star"></span>
                                </div>
                                <div class="_rate002">{{$state['5_star']}}%</div>
                            </div>
                            <div class="_rate004">
                                <div class="progress progress1">
                                    <div class="progress-bar " role="progressbar" aria-valuenow="{{$state['4_star']}}"
                                        aria-valuemin="0" aria-valuemax="100" style="width:{{$state['4_star']}}%">
                                    </div>
                                </div>
                                <div class="rating-box">
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star empty-star"></span>
                                </div>
                                <div class="_rate002">{{$state['4_star']}}%</div>
                            </div>
                            <div class="_rate004">
                                <div class="progress progress1">
                                    <div class="progress-bar " role="progressbar" aria-valuenow="{{$state['3_star']}}"
                                        aria-valuemin="0" aria-valuemax="100" style="width:{{$state['3_star']}}%">
                                    </div>
                                </div>
                                <div class="rating-box">
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star empty-star"></span>
                                    <span class="rating-star empty-star"></span>
                                </div>
                                <div class="_rate002">{{$state['3_star']}}%</div>
                            </div>
                            <div class="_rate004">
                                <div class="progress progress1">
                                    <div class="progress-bar " role="progressbar" aria-valuenow="{{$state['2_star']}}"
                                        aria-valuemin="0" aria-valuemax="100" style="width:{{$state['2_star']}}%">
                                    </div>
                                </div>
                                <div class="rating-box">
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star empty-star"></span>
                                    <span class="rating-star empty-star"></span>
                                    <span class="rating-star empty-star"></span>
                                </div>
                                <div class="_rate002">{{$state['2_star']}}%</div>
                            </div>
                            <div class="_rate004">
                                <div class="progress progress1">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="{{$state['1_star']}}"
                                        aria-valuemin="0" aria-valuemax="100" style="width:{{$state['1_star']}}%">
                                    </div>
                                </div>
                                <div class="rating-box">
                                    <span class="rating-star full-star"></span>
                                    <span class="rating-star empty-star"></span>
                                    <span class="rating-star empty-star"></span>
                                    <span class="rating-star empty-star"></span>
                                    <span class="rating-star empty-star"></span>
                                </div>
                                <div class="_rate002">{{$state['1_star']}}%</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="review_right">
                        <div class="review_right_heading">
                            <h3>{{__('All Reviews')}}</h3>
                           
                        </div>
                    </div>
                    
                    
                    @forelse ($reviews as $review)
                    <div class="review_all120 mb-30">
                        <div class="review_item_course_title">
                            <a href="#">{{$review->course->title ?? 'No Data'}}</a>
                        </div>
                        <div class="review_item">
                            <div class="review_usr_dt">
                                <img src="{{ asset($review->student->image ?? 'default.png') }}" alt="">
                                <div class="rv1458">
                                    <h4 class="tutor_name1">{{$review->student->name ?? 'No Data'}}</h4>
                                    <span class="time_145">{{$review->updated_at->diffForHumans()}}</span>
                                </div>
                            </div>
                            <div class="rating-box mt-20">
                                @for ($i = 0; $i < 5;$i++) <span
                                    class="rating-star {{$review->star > $i ? 'full-star' : 'empty-star'}}">
                                    </span>
                                    @endfor
                            </div>
                            <p class="rvds10">{{$review->msg}}</p>
                        </div>
                    </div>
                   
                    @empty
                    <x-nodata></x-nodata>
                    
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection