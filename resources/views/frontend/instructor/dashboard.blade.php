@extends('frontend.layouts.ins-master')

@push('styles')

<link href="{{ asset('frontend/css/instructor-dashboard.css')}}" rel="stylesheet">
<link href="{{ asset('frontend/css/instructor-responsive.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2 class="st_title"><i class="uil uil-apps"></i> {{__('Instructor Dashboard')}}</h2>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6">
        <div class="card_dash">
            <div class="card_dash_left">
                <h5>{{__('Total Sales')}}</h5>
                <h2>{{$admin_setting[7]['value']}}{{$master['total_sell']}}</h2>
                <span class="crdbg_1">{{__('Today')}} {{$admin_setting[7]['value']}}{{$master['total_sell_d']}}</span>
            </div>
            <div class="card_dash_right">
                <img src="{{ asset('frontend/images/dashboard/achievement.svg') }}" alt="">
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6">
        <div class="card_dash">
            <div class="card_dash_left">
                <h5>{{__('Total Enroll')}}</h5>
                <h2>{{$master['total_enroll']}}</h2>
                <span class="crdbg_2">{{__('Today')}} {{$master['total_enroll_d']}}</span>
            </div>
            <div class="card_dash_right">
                <img src="{{ asset('frontend/images/dashboard/graduation-cap.svg') }}" alt="">
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6">
        <div class="card_dash">
            <div class="card_dash_left">
                <h5>{{__('Total Courses')}}</h5>
                <h2>{{$master['total_student']}}</h2>
                <span class="crdbg_3">{{__('Today')}} {{$master['total_student_d']}}</span>
            </div>
            <div class="card_dash_right">
                <img src="{{ asset('frontend/images/dashboard/online-course.svg') }}" alt="">
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6">
        <div class="card_dash">
            <div class="card_dash_left">
                <h5>{{__('Total Students')}}</h5>
                <h2>{{$master['course_count']}}</h2>
                <span class="crdbg_4">{{__('Today')}} {{$master['course_count_d']}}</span>
            </div>
            <div class="card_dash_right">
                <img src="{{ asset('frontend/images/dashboard/knowledge.svg') }}" alt="">
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card_dash1">
            <div class="card_dash_left1">
                <i class="uil uil-book-alt"></i>
                <h1>{{__('Jump Into Course Creation')}}</h1>
            </div>
            <div class="card_dash_right1">
                <button class="create_btn_dash"
                    onclick="window.location.href ='{{ route('courses.create') }}';">{{__('Create Your Course')}}</button>
            </div>
        </div>
    </div>
</div>
<div class="row">

    <div class=" col-lg-12 col-md-12">
        <div class="section3125 mt-50">
            <h4 class="item_title">{{__('Profile Analytics')}}</h4>
            <div class="la5lo1">
                <div class="fcrse_1">
                    <div class="fcrse_content">
                        <h6 class="crsedt8145">{{__('Current subscribers')}}</h6>
                        <h3 class="subcribe_title">{{$master['total_subscribers']}}</h3>
                        <div class="allvperf">
                            <div class="crse-perf-left">{{__('View')}}</div>
                            <div class="crse-perf-right">{{$master['total_subscribers']}}<span class="analyics_pr">
                                    ({{$master['total_subscribers_d']}})</span>
                            </div>
                        </div>
                        <div class="allvperf">
                            <div class="crse-perf-left">{{__('Sell')}}<span class="per_text">{{__('(today)')}}</span>
                            </div>
                            <div class="crse-perf-right">{{$master['total_sell']}}<span class="analyics_pr">
                                    ({{$master['total_sell_d']}})</span></div>
                        </div>
                        <div class="allvperf">
                            <div class="crse-perf-left">{{__('Enroll')}}<span class="per_text">{{__('(today)')}}</span>
                            </div>
                            <div class="crse-perf-right">{{$master['total_enroll']}}<span class="analyics_pr">
                                    ({{$master['total_enroll_d']}})</span></div>
                        </div>
                        <div class="auth1lnkprce">
                            <a href="{{ route('ins-analytics') }}"
                                class="cr1fot50">{{__('Go to profile analytics')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (count($master['review_c']))

        <div class="section3125 mt-50">
            <h4 class="item_title">{{__('Submit Courses')}}</h4>
            <div class="la5lo1">
                @foreach ($master['review_c'] as $item)

                <div class="fcrse_1 mb-10">
                    <div class="fcrse_content">
                        <div class="upcming_card">
                            <a href="#" class="crsedt145">{{$item->title}}<span
                                    class="pndng_145">{{__('Pending')}}</span></a>
                            <p class="submit-course">
                                {{__('Submitted')}}<span>{{$item->created_at->diffForHumans()}}</span></p>
                            <form action="{{ route('courses.destroy', $item) }}" method="post">
                                @csrf
                                @method('delete')
                                <a href="#" type="submit"
                                    onclick="confirm('{{ __("Are you sure you want to delete this?") }}') ? this.parentElement.submit() : ''"
                                    title="Delete" class="delete_link10">{{__('Delete')}}</a>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        <div class="section3125 mt-50">
            <h4 class="item_title">{{__('Latest Sell')}}</h4>
            <div class="la5lo1">

                @foreach ($master['l_sell'] as $item)

                <div class="fcrse_1 mb-1">
                    <div class="fcrse_content">
                        <a class="new_links10">{{$item->course->title  ?? "NO Data"}} <div class="crse-perf-right"><span
                                    class="analyics_pr">
                                    {{$admin_setting[7]['value']}}{{$item->price}}</span></div> </a>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

@endpush