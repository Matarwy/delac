@extends('frontend.layouts.ins-master')
@push("styles")
<link href="{{ asset('frontend/css/video-js.css')}}" rel="stylesheet" />
<style>
    /* Rating Star Widgets Style */
    .rating-stars ul {
        list-style-type: none;
        padding: 0;

        -moz-user-select: none;
        -webkit-user-select: none;
    }

    .rating-stars ul>li.star {
        display: inline-block;

    }

    /* Idle State of the stars */
    .rating-stars ul>li.star>i.fa {
        font-size: 19px;
        /* Change the size of the stars */
        color: #ccc;
        /* Color on idle state */
    }

    /* Hover state of the stars */
    .rating-stars ul>li.star.hover>i.fa {
        color: #FFCC36;
    }

    /* Selected state of the stars */
    .rating-stars ul>li.star.selected>i.fa {
        color: #FF912C;
    }

    #my-video,
    #let-video {
        height: 100%;
        width: 100%;
    }

       /* Layout for this demo */
  .wrap{
    position: relative;
    max-width: 1000px;
    width: 95%;
    margin: 15px auto;
  }
  
   /* The outer-div to move the elements */
  .box-video{
    position: relative;
    width: 100%;
    margin:0 auto 20px auto;
    cursor: pointer;
    overflow: hidden;
  }
  
   /* Set Cover aka Background-Image */
  .box-video .bg-video{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    z-index: 2;
  }
  
   /* Add light shade to make play button visible*/
  .bg-video::after{ 
        content:'';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.2);
        z-index: 3;
}
  
    /* The Play-Button using CSS-Only */
    .box-video .bt-play {
        position: absolute;
        top:50%;
        left:50%;
        margin:-30px 0 0 -30px;
        display: inline-block;
        width: 60px;
        height: 60px;
        background: rgba(255,255,255,0.1);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 50%;
        text-indent: -999em;
        cursor: pointer;
        z-index:2;
        -webkit-transition: all .3s ease-out;
        transition: all .3s ease-out;
    }
    
    /* The Play-Triangle */
    .box-video .bt-play:after {
        content: '';
        position: absolute;
        left: 50%;
        top: 50%;
        height: 0;
        width: 0;
        margin: -12px 0 0 -6px;
        border: solid transparent;
        border-left-color: #000;
        border-width: 12px 20px;
        -webkit-transition: all .3s ease-out;
        transition: all .3s ease-out;
    }
    
    .box-video:hover .bt-play {
        transform: scale(1.1);
    }

    /* When Class added the Cover gets hidden... */
    .box-video.open .bg-video{
        visibility: hidden;
        opacity: 0;

        -webkit-transition: all .6s .8s;
        transition: all .6s .8s;  
    }

    /* and iframe shows up */
    .box-video.open .video-container{
        opacity: 1;
        -webkit-transition: all .6s .8s;
        transition: all .6s .8s;
    }
</style>
@endpush
@section('content')
<div class="modal vd_mdl fade" id="videoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body">
                <video id="my-video" class="video-js vjs-theme-forest" controls preload="auto"
                    poster="{{asset($course->cover_image) }}" data-setup="{}">
                    <source src="{{ asset( $course->promotional_video)}}" type="video/{{substr($course->promotional_video, strpos($course->promotional_video, ".") + 1)}}" />
                </video>
            </div>

        </div>
    </div>
</div>
<div class="modal vd_mdl fade" id="let-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title" id="let-header">Modal Header</h4>
                <button type="button" class=" btn-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                {{-- <div class="video-div">

                    <video id="let-video" class="video-js vjs-theme-forest" controls preload="auto"
                        poster="{{asset($course->cover_image) }}" data-setup="{}">
                        <source src="{{ asset('demo.mp4') }}" type="video/mp4" />
                    </video>
                </div> --}}
                <div class="box-video">
                    <div class="bg-video" style="background-image: url({{asset($course->cover_image) }});">
                        <div class="bt-play">Play</div>
                    </div>
                    <div class="video-container">
                        <iframe width="590" height="332" src=""></iframe>
                    </div>
                </div>

                <div class="p-4">
                    <h4>{{__('Detail')}}</h4>
                    <span id="let-detail">

                    </span>
                </div>

            </div>

        </div>
    </div>
</div>
<div class="_215b01">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="section3125">
                    <div class="row justify-content-center">
                        <div class="col-xl-4 col-lg-5 col-md-6">
                            <div class="preview_video">
                                <a href="#" class="fcrse_img" data-toggle="modal" data-target="#videoModal">
                                    <img src="{{asset($course->cover_image) }}" alt="">
                                    <div class="course-overlay">
                                        @if ($course->is_bestseller)

                                        <div class="badge_seller">{{__('Bestseller')}}</div>
                                        @endif

                                        @if ($discount)

                                        <div class="crse_reviews bg-danger">
                                            <i class="uil uil-pricetag-alt"></i>{{$discount->percentage}}%
                                        </div>

                                        @endif
                                        <span class="play_btn1"><i class="uil uil-play"></i></span>
                                        <span class="_215b02">{{__('Preview this course')}}</span>

                                    </div>

                                </a>
                            </div>
                            <div class="_215b10">
                                @if ($course->is_saved == 1)

                                <a href="{{ route('removefromsave',['id'=>$course->id]) }}" class="_215b11 avt-btn">
                                    <span><i class="uil uil-heart"></i></span>{{__('Saved')}}
                                </a>
                                @else

                                <a href="{{ route('addtosave',['id'=>$course->id]) }}" class="_215b11">
                                    <span><i class="uil uil-heart"></i></span>{{__('Save')}}
                                </a>
                                @endif
                                @if ($course->is_reported == 1)
                                <a href="#" class="_215b12 avt-btn">
                                    <span><i class="uil uil-windsock"></i></span>{{__('Reported')}}
                                </a>
                                @else
                                <a href="{{ route('addtoreport',['id'=>$course->id]) }}" class="_215b12">
                                    <span><i class="uil uil-windsock"></i></span>{{__('Report abuse')}}
                                </a>
                                @endif


                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-7 col-md-6">
                            <div class="_215b03">
                                <h2>{{$course->title}}</h2>
                                <span class="_215b04">{{$course->subtitle}}</span>
                            </div>
                            <div class="_215b05">
                                <div class="crse_reviews mr-2">
                                    <i class="uil uil-star"></i>{{$course->avg_rating}}
                                </div>
                                ({{number_format(count($course->reviews))}} {{__('ratings')}})
                            </div>
                            <div class="_215b05">
                                {{number_format($course->enroll_count)}} {{__('students enrolled')}}
                            </div>
                            <div class="_215b06">
                                <div class="_215b07">
                                    <span><i class='uil uil-comment'></i></span>
                                    {{$course->language->name ?? "No Data"}}
                                </div>

                            </div>
                            <div class="_215b05">
                                {{__('Last updated')}} {{$course->updated_at->format('m/Y')}}
                            </div>
                            <ul class="_215b31">
                                @if ($course->is_buy >= 1)
                                <li><button class="btn_buy">{{__('Watch Now')}}</button></li>
                                @else

                                @if ($course->in_cart == 1)
                                <li><button class="btn_adcart bg-light text-dark"
                                        onclick="window.location.href = '{{ route('removefromcart',['id'=>$course->id]) }}';">{{__('Remove
                                        From Cart')}}</button></li>
                                @else
                                <li><button class="btn_adcart"
                                        onclick="window.location.href = '{{ route('addtocart',['id'=>$course->id]) }}';">{{__('Add
                                        to Cart')}}</button></li>
                                @endif
                                <li><button class="btn_buy" onclick="window.location.href = '{{ route('addtocart',['id'=>$course->id, 'from'=>'buy']) }}';">{{__('Buy Now')}}</button></li>
                                @endif
                            </ul>
                            <div class="_215fgt1">
                                {{__('30-Day Money-Back Guarantee')}}
                            </div>
                            @if ($discount)
                            <div class="_215fgt1 text-danger">
                                {{$discount->title}} {{__('till')}} {{$discount->end_time->format('d M,Y')}}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="_215b15 _byt1458">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="user_dt5">
                    <div class="user_dt_left">
                        <div class="live_user_dt">
                            <div class="user_img5">
                                <a href="#"><img src="{{ asset($course->instructor->image) }}" alt=""></a>
                            </div>
                            <div class="user_cntnt">
                                <a href="#" class="_df7852">{{$course->instructor->name ?? "No Data"}}</a>
                                @if ($course->ins_sub == 1)
                                <button class="subscribe-btn bg-light text-dark"
                                    onclick="window.location.href = '{{ route('unsubscribe',['id'=>$course->instructor_id]) }}';">{{__('Subscribed')}}</button>
                                @else
                                <button class="subscribe-btn"
                                    onclick="window.location.href = '{{ route('subscribe',['id'=>$course->instructor_id]) }}';">{{__('Subscribe')}}</button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="user_dt_right">
                        <ul>
                            <li>
                                <a class="lkcm152"><i
                                        class="uil uil-eye"></i><span>{{$course->shortNumber($course->views)}}</span></a>
                            </li>
                            <li>
                                @if ($course->is_like == 0)

                                <a href="{{ route('deletelikedislike',['id'=>$course->id]) }}" class="lkcm152 avt-btn">
                                    <i class="uil uil-thumbs-up"></i>
                                    <span>{{$course->shortNumber($course->likes)}}</span>
                                </a>
                                @else
                                <a href="{{ route('likedislike',['id'=>$course->id,'what'=> 0]) }}" class="lkcm152">
                                    <i class="uil uil-thumbs-up"></i>
                                    <span>{{$course->shortNumber($course->likes)}}</span>
                                </a>
                                @endif

                            </li>
                            <li>
                                @if ($course->is_like == 1)
                                <a href="{{ route('deletelikedislike',['id'=>$course->id]) }}" class="lkcm152 avt-btn">
                                    <i class="uil uil-thumbs-down"></i>
                                    <span>{{$course->shortNumber($course->dislikes)}}</span>
                                </a>
                                @else
                                <a href="{{ route('likedislike',['id'=>$course->id,'what'=> 1]) }}" class="lkcm152"><i
                                        class="uil uil-thumbs-down"></i>
                                    <span>{{$course->shortNumber($course->dislikes)}}</span>
                                </a>
                                @endif

                            </li>
                            <li>
                                <a onclick="window.open('{{ route('courseShare', ['slug'=> str_replace(' ', '-', strtolower($course->title)),'id' => $course->id]) }}','popup','width=600,height=600,scrollbars=no,resizable=no'); return false;"
                                    class="lkcm152"><i
                                        class="uil uil-share-alt"></i><span>{{$course->shortNumber($course->share)}}</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="course_tabs">
                    <nav>
                        <div class="nav nav-tabs tab_crse justify-content-center" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-about-tab" data-toggle="tab" href="#nav-about"
                                role="tab" aria-selected="true">{{__('About')}}</a>
                            <a class="nav-item nav-link" id="nav-courses-tab" data-toggle="tab" href="#nav-courses"
                                role="tab" aria-selected="false">{{__('Courses Content')}}</a>
                            <a class="nav-item nav-link" id="nav-reviews-tab" data-toggle="tab" href="#nav-reviews"
                                role="tab" aria-selected="false">{{__('Reviews')}}</a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="_215b17">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="course_tab_content">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-about" role="tabpanel">
                            <div class="_htg451">
                                {!!clean($course->description)!!}
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-courses" role="tabpanel">
                            <div class="crse_content">
                                <h3>{{__('Course content')}}</h3>
                                <div class="_112456">
                                    <ul class="accordion-expand-holder">
                                        <li><span class="accordion-expand-all _d1452">{{__('Expand all')}}</span></li>
                                        <li><span class="_fgr123"> {{$course->lectures_count}} {{__('lectures')}}</span>
                                        </li>
                                        <li><span class="_fgr123">{{$course->lectures_length}}</span></li>
                                    </ul>
                                </div>
                                <div id="accordion" class="ui-accordion ui-widget ui-helper-reset">
                                    @foreach ($course->content as $content)


                                    <a href="javascript:void(0)"
                                        class="accordion-header ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all">
                                        <div class="section-header-left">
                                            <span class="section-title-wrapper">
                                                <i class='uil uil-presentation-play crse_icon'></i>
                                                <span class="section-title-text">{{$content->title}}</span>
                                            </span>
                                        </div>
                                        <div class="section-header-right">
                                            <span class="num-items-in-section">{{count($content->lectures)}}
                                                {{__('lectures')}}</span>
                                            <span
                                                class="section-header-length">{{$content->lecturesLength($content->id)}}</span>
                                        </div>
                                    </a>
                                    <div
                                        class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom">
                                        @foreach ($content->lectures as $lecture)

                                        <div class="lecture-container">
                                            <div class="left-content">
                                                @if ($lecture->file_type == 0)

                                                <i class='uil uil-file-download-alt icon_142'></i>
                                                @elseif($lecture->file_type == 1)
                                                <i class='uil uil-play-circle icon_142'></i>
                                                @else
                                                <i class='uil uil-file icon_142'></i>
                                                @endif
                                                <div class="top">
                                                    <div class="title">{{$lecture->title}}</div>
                                                </div>
                                            </div>
                                            <div class="details">
                                                @if ($course->is_buy >= 1)
                                                @if ($lecture->file_type == 1)
                                                @php
                                                $dis = $lecture->description;
                                                $lecture->description= "";
                                                @endphp
                                                <a href="#" class="preview-text"
                                                    onclick="openletModel('{{$lecture}}',`{{$dis}}`)"
                                                    data-toggle="modal" data-target="#let-modal">{{__('View')}}</a>
                                                @else
                                                <a href="{{ asset($lecture->file) }}" target="_blank"
                                                    class="preview-text">{{__('Download')}}</a>
                                                @endif
                                                @endif
                                                <span class="content-summary">
                                                    {{$lecture->hoursandmins($lecture->duration)}}</span>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endforeach
                                </div>
                                <a class="btn1458" href="#">{{count($course->content)}} {{__('Sections')}}</a>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-reviews" role="tabpanel">
                            <div class="student_reviews">
                                <div class="row">
                                    <div class="col-lg-5">
                                        @if ($course->is_buy >= 1)

                                        <div class="reviews_left">
                                            <h3>{{__('Your Feedback')}}</h3>
                                            <div class="total_rating">

                                                <div class="_rate001">{{__('Course Rating')}}</div>
                                                <div class='rating-stars text-center'>
                                                    <ul id='stars'>
                                                        @php
                                                        $os =$course['own_rating']['star'] ?? 0;
                                                        @endphp
                                                        <li class='star {{$os >= 1 ? 'hover selected' : ''}}'
                                                            title='Poor' data-value='1'>
                                                            <i class='fa fa-star fa-fw'></i>
                                                        </li>
                                                        <li class='star {{$os >= 2 ? 'hover selected' : ''}}'
                                                            title='Fair' data-value='2'>
                                                            <i class='fa fa-star fa-fw'></i>
                                                        </li>
                                                        <li class='star {{$os >= 3 ? 'hover selected' : ''}}'
                                                            title='Good' data-value='3'>
                                                            <i class='fa fa-star fa-fw'></i>
                                                        </li>
                                                        <li class='star {{$os >= 4 ? 'hover selected' : ''}}'
                                                            title='Excellent' data-value='4'>
                                                            <i class='fa fa-star fa-fw'></i>
                                                        </li>
                                                        <li class='star {{$os >= 5 ? 'hover selected' : ''}}'
                                                            title='WOW!!!' data-value='5'>
                                                            <i class='fa fa-star fa-fw'></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <form action="{{ url('ratting') }}" method="post">
                                                @csrf
                                                <div class="basic_form">

                                                    <input type="hidden" name="course_id" value="{{$course->id}}">
                                                    <input type="hidden" name="star"
                                                        value="{{$course['own_rating']['star'] ?? 0 }}" id="rateinput">
                                                    <div class="ui search focus mt-3">
                                                        <div class="ui left icon input swdh11 swdh19">

                                                            <textarea id="review-msg" name="msg"
                                                                class="prompt srch_explore" cols="30" rows="10"
                                                                placeholder="{{__('Your feedback.')}}" required
                                                                minlength="20">{{$course['own_rating']['msg'] ?? ''}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn_adcart mt-3 float-right" type="submit">{{__('Give
                                                    Review')}}</button>
                                            </form>
                                        </div>
                                        @endif
                                        <div class="reviews_left mt-2">
                                            <h3>{{__('Student Feedback')}}</h3>
                                            <div class="total_rating">
                                                <div class="_rate001">{{$course->avg_rating}}</div>
                                                <div class="rating-box">

                                                    @for ($i = 0; $i < 5;$i++) <span
                                                        class="rating-star {{$course->avg_rating > $i ? 'full-star' : 'empty-star'}}">
                                                        </span>
                                                        @endfor
                                                </div>
                                                <div class="_rate002">{{__('Course Rating')}}</div>
                                            </div>
                                            <div class="_rate003">
                                                <div class="_rate004">
                                                    <div class="progress progress1">
                                                        <div class="progress-bar " role="progressbar"
                                                            aria-valuenow="{{$course['5_star']}}" aria-valuemin="0"
                                                            aria-valuemax="100" style="width:{{$course['5_star']}}%">
                                                        </div>
                                                    </div>
                                                    <div class="rating-box">
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                    </div>
                                                    <div class="_rate002">{{$course['5_star']}}%</div>
                                                </div>
                                                <div class="_rate004">
                                                    <div class="progress progress1">
                                                        <div class="progress-bar " role="progressbar"
                                                            aria-valuenow="{{$course['4_star']}}" aria-valuemin="0"
                                                            aria-valuemax="100" style="width:{{$course['4_star']}}%">
                                                        </div>
                                                    </div>
                                                    <div class="rating-box">
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star empty-star"></span>
                                                    </div>
                                                    <div class="_rate002">{{$course['4_star']}}%</div>
                                                </div>
                                                <div class="_rate004">
                                                    <div class="progress progress1">
                                                        <div class="progress-bar " role="progressbar"
                                                            aria-valuenow="{{$course['3_star']}}" aria-valuemin="0"
                                                            aria-valuemax="100" style="width:{{$course['3_star']}}%">
                                                        </div>
                                                    </div>
                                                    <div class="rating-box">
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star empty-star"></span>
                                                        <span class="rating-star empty-star"></span>
                                                    </div>
                                                    <div class="_rate002">{{$course['3_star']}}%</div>
                                                </div>
                                                <div class="_rate004">
                                                    <div class="progress progress1">
                                                        <div class="progress-bar " role="progressbar"
                                                            aria-valuenow="{{$course['2_star']}}" aria-valuemin="0"
                                                            aria-valuemax="100" style="width:{{$course['2_star']}}%">
                                                        </div>
                                                    </div>
                                                    <div class="rating-box">
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star empty-star"></span>
                                                        <span class="rating-star empty-star"></span>
                                                        <span class="rating-star empty-star"></span>
                                                    </div>
                                                    <div class="_rate002">{{$course['2_star']}}%</div>
                                                </div>
                                                <div class="_rate004">
                                                    <div class="progress progress1">
                                                        <div class="progress-bar" role="progressbar"
                                                            aria-valuenow="{{$course['1_star']}}" aria-valuemin="0"
                                                            aria-valuemax="100" style="width:{{$course['1_star']}}%">
                                                        </div>
                                                    </div>
                                                    <div class="rating-box">
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star empty-star"></span>
                                                        <span class="rating-star empty-star"></span>
                                                        <span class="rating-star empty-star"></span>
                                                        <span class="rating-star empty-star"></span>
                                                    </div>
                                                    <div class="_rate002">{{$course['1_star']}}%</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="review_right">
                                            <div class="review_right_heading">
                                                <h3>{{__('Reviews')}}</h3>
                                                <div class="review_search">
                                                    <input class="rv_srch" type="text"
                                                        placeholder="{{__('Search reviews...')}}">
                                                    <button class="rvsrch_btn"><i class='uil uil-search'></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="review_all120">
                                            @foreach ($course->reviews as $review)
                                            <div class="review_item">
                                                <div class="review_usr_dt">
                                                    <img src="{{ asset($review->student->image ?? 'default.png') }}"
                                                        alt="">
                                                    <div class="rv1458">
                                                        <h4 class="tutor_name1">{{$review->student->name ?? 'No Data'}}
                                                        </h4>
                                                        <span
                                                            class="time_145">{{$review->updated_at->diffForHumans()}}</span>
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
                                            @endforeach

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
@endsection
@push("scripts")
<script src="{{ asset('frontend/js/video.min.js')}}"></script>
<script>
    "use strict";
    var url;
    $(".box-video").click(function(){
        $('iframe',this)[0].src += "?autoplay=1";
        $('#let-modal .box-video .video-container iframe').attr('src',url);
        $(this).addClass('open');
    });
    
    $('#let-modal').on('hidden.bs.modal', function () {
        $('.box-video').removeClass('open');
        $('#let-modal .box-video .video-container iframe').attr('src','');
    });
    
    function openletModel(data,dis){
        url = '';
        data = JSON.parse(data,)
        var file = data.file
        $("#let-header").html(data.title);
        $("#let-detail").html(dis);
        url = '{{asset("/")}}/'+data.file;
    }
    $(function () {


    $('#stars li').on('mouseover', function () {
    var onStar = parseInt($(this).data('value'), 10);


    $(this).parent().children('li.star').each(function (e) {
    if (e < onStar) { $(this).addClass('hover'); } else { $(this).removeClass('hover'); } }); }).on('mouseout', function ()
        { $(this).parent().children('li.star').each(function (e) { $(this).removeClass('hover'); }); });
         $('#stars li').on('click', function () { var onStar=parseInt($(this).data('value'), 10);
          var stars=$(this).parent().children('li.star'); for (i=0; i < stars.length; i++) {
        $(stars[i]).removeClass('selected'); } for (i=0; i < onStar; i++) { $(stars[i]).addClass('selected'); }
         var ratingValue=parseInt($('#stars li.selected').last().data('value'), 10); var msg="" ; if
        (ratingValue> 1) {
        msg = "Thanks! You rated this " + ratingValue + " stars.";
        } else {
        msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
        }
    $('#rateinput').val(ratingValue);
        });


        });
</script>
@endpush
