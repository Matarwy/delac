@extends('frontend.layouts.ins-master')
@section('content')
@php
$categorys = \App\Models\Category::whereStatus(1)->inRandomOrder()->limit(5)->get();
@endphp
<div class="row">
    <div class="col-xl-9 col-lg-8">
        <div class="section3125">
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
        <div class="section3125 mt-50">
            <h4 class="item_title">{{__('Featured Courses')}}</h4>
            <a href="{{ route('coursesAll', ['type'=>'featured']) }}" class="see150">{{__('See all')}}</a>
            <div class="la5lo1">
                <div class="owl-carousel featured_courses owl-theme">
                    @foreach ($coursesfeatured as $course)
                    <x-horizontal-courses :course="$course"></x-horizontal-courses>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="section3125 mt-30">
            <h4 class="item_title">{{__('Newest Courses')}}</h4>
            <a href="{{ route('coursesAll', ['type'=>'latest']) }}" class="see150">{{__('See all')}}</a>
            <div class="la5lo1">
                <div class="owl-carousel featured_courses owl-theme">
                    @foreach ($courses as $course)
                    <x-horizontal-courses :course="$course"></x-horizontal-courses>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="section3126">
            <div class="row">
                <div class="col-xl-6 col-lg-12 col-md-6">
                    <div class="value_props">
                        <div class="value_icon">
                            <i class='uil uil-history'></i>
                        </div>
                        <div class="value_content">
                            <h4>{{__('Go at your own pace')}}</h4>
                            <p>{{__('Enjoy lifetime access to courses on  website')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12 col-md-6">
                    <div class="value_props">
                        <div class="value_icon">
                            <i class='uil uil-user-check'></i>
                        </div>
                        <div class="value_content">
                            <h4>{{__('Learn from industry experts')}}</h4>
                            <p>{{__('Select from top instructors around the world')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12 col-md-6">
                    <div class="value_props">
                        <div class="value_icon">
                            <i class='uil uil-play-circle'></i>
                        </div>
                        <div class="value_content">
                            <h4>{{__('Find video courses on almost any topic')}}</h4>
                            <p>{{__('Build your library for your career and personal growth')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12 col-md-6">
                    <div class="value_props">
                        <div class="value_icon">
                            <i class='uil uil-presentation-play'></i>
                        </div>
                        <div class="value_content">
                            <h4>{{__('100,000 online courses')}}</h4>
                            <p>{{__('Explore a variety of fresh topics')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section3125 mt-50">
            <h4 class="item_title">{{__('Popular Instructors')}}</h4>
            <a href="{{ route('instructorAll') }}" class="see150">{{__('See all')}}</a>
            <div class="la5lo1">
                <div class="owl-carousel top_instrutors owl-theme">
                   
                    @foreach ($instructors as $item)
                    <x-sqaure-instructors :ins="$item"></x-sqaure-instructors>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-4">
        <div class="right_side">
            @if ($inst)
            <div class="fcrse_2 mb-30">
                <div class="tutor_img">
                    <a
                        href="{{ route('instructorShow', ['id'=>$inst->id,'slug'=>  str_replace(' ', '-', strtolower($inst->name))]) }}"><img
                            src="{{ asset($inst->image) }}" alt=""></a>
                </div>
                <div class="tutor_content_dt">
                    <div class="tutor150">
                        <a href="{{ route('instructorShow', ['id'=>$inst->id,'slug'=>  str_replace(' ', '-', strtolower($inst->name))]) }}"
                            class="tutor_name">{{$inst->name}}</a>
                        @if ($inst->verify_pro)
                        <div class="mef78" title="Verify">
                            <i class="uil uil-check-circle"></i>
                        </div>
                        @endif
                    </div>
                    <div class="tutor_cate">{{$inst->headline}}</div>
                    <ul class="tutor_social_links">
                        <li><a href="http://facebook.com/{{$inst->facebook}}" class="fb"><i
                                    class="fab fa-facebook-f"></i></a></li>
                        <li><a href="http://twitter.com/{{$inst->twitter}}" class="tw"><i
                                    class="fab fa-twitter"></i></a></li>
                        <li><a href="http://www.linkedin.com/{{$inst->linkedin}}" class="ln"><i
                                    class="fab fa-linkedin-in"></i></a></li>
                        <li><a href="http://www.youtube.com/{{$inst->youtube}}" class="yu"><i
                                    class="fab fa-youtube"></i></a></li>
                    </ul>
                    <div class="tut1250">
                        <span class="vdt15">{{$inst->shortNumber($inst->enroll_count)}} {{__('Students')}}</span>
                        <span class="vdt15">{{$inst->courses_count}} {{__('Courses')}}</span>
                    </div>
                    <a href="{{ route('instructorShow', ['id'=>$inst->id,'slug'=>  str_replace(' ', '-', strtolower($inst->name))]) }}"
                        class="prfle12link">{{__('Go To Profile')}}</a>
                </div>
            </div>
            @endif
            <div class="get1452">
                <h4>{{__('Become an Instructor')}}</h4>
                <p>{{__('Top instructors from around the world teach millions of students on Delac. We provide the tools and
                    skills to teach what you love.')}}</p>
                <button class="Get_btn" onclick="window.location.href = '{{url('instructor/register')}}';">{{__('Start
                    Teaching')}}</button>
            </div>
            <div class="fcrse_3">
                <div class="cater_ttle">
                    <h4>{{__('Live Streaming')}}</h4>
                </div>
                <div class="live_text">
                    <div class="live_icon"><i class="uil uil-kayak"></i></div>
                    <div class="live-content">
                        <p>{{__('Set up your channel and stream live to your students')}}</p>
                        <button class="live_link" onclick="window.location.href = '{{url('instructor/live-stream')}}';">{{__('Get
                            Started')}}</button>
                        <span class="livinfo">{{__('Info : This feature only for Instructors.')}}</span>
                    </div>
                </div>
            </div>

            <div class="fcrse_3">
                <div class="cater_ttle">
                    <h4>{{__('Top Categories')}}</h4>
                </div>
                <ul class="allcate15">
                    @foreach($categorys as $cat)

                    <li><a href="{{ route('categoriesCourses',['slug'=> str_replace(' ', '-', strtolower($cat->name)),'id' => $cat->id]) }}" class="ct_item"></i>{{$cat->name}}</a></li>
                    @endforeach

                </ul>
            </div>
            <div class="strttech120">
                <h4>{{__('Become an Instructor')}}</h4>
                <p>{{__('Top instructors from around the world teach millions of students on Delac. We provide the tools and
                    skills to teach what you love.')}}</p>
                <button class="Get_btn" onclick="window.location.href = '{{url('instructor/register')}}';">{{__('Start
                    Teaching')}}</button>
            </div>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12">
        <div class="section3125 mt-30">
            <h4 class="item_title">{{__('What Our Student Have Today')}}</h4>
            <div class="la5lo1">
                <div class="owl-carousel Student_says owl-theme">
                    @foreach ($ratting as $rate)


                    <div class="item">
                        <div class="fcrse_4 mb-20">
                            <div class="say_content">
                                <p>{{$rate->msg}}
                                </p>
                            </div>
                            <div class="st_group">
                                <div class="stud_img">
                                    <img src="{{ asset($rate->student->image) }}" alt="">
                                </div>
                                <h4>{{ $rate->student->name }}</h4>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection