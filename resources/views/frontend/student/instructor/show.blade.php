@extends('frontend.layouts.ins-master')
@section('content')
<div class="_216b01">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="section3125 rpt145">
                    <div class="row">
                        <div class="col-lg-7">
                            
                            <div class="dp_dt150">
                                <div class="img148">
                                    <img src="{{ asset($inst->image) }}" alt="">
                                </div>
                                <div class="prfledt1">
                                    <h2>{{$inst->name}}</h2>
                                    <span>{{$inst->headline}}</span>
                                </div>
                            </div>
                            <ul class="_ttl120">
                                <li>
                                    <div class="_ttl121">
                                        <div class="_ttl122">{{__('Enroll Students')}}</div>
                                        <div class="_ttl123">{{$inst->shortNumber($inst->enroll_count)}}</div>
                                    </div>
                                </li>
                                <li>
                                    <div class="_ttl121">
                                        <div class="_ttl122">{{__('Courses')}}</div>
                                        <div class="_ttl123">{{count($inst->courses)}}</div>
                                    </div>
                                </li>
                                <li>
                                    <div class="_ttl121">
                                        <div class="_ttl122">{{__('Reviews')}}</div>
                                        <div class="_ttl123">{{$inst->shortNumber($inst->crc)}}</div>
                                    </div>
                                </li>
                                <li>
                                    <div class="_ttl121">
                                        <div class="_ttl122">{{__('Subscribers')}}</div>
                                        <div class="_ttl123">{{$inst->shortNumber($inst->subscribers_count)}}</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-5">
                          
                            <div class="rgt-145">
                                <ul class="tutor_social_links">
                                    <li><a href="http://facebook.com/{{$inst->facebook}}" class="fb"><i class="fab fa-facebook-f"></i></a>
                                    </li>
                                    <li><a href="http://twitter.com/{{$inst->twitter}}" class="tw"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="http://www.linkedin.com/{{$inst->linkedin}}" class="ln"><i class="fab fa-linkedin-in"></i></a>
                                    </li>
                                    <li><a href="http://www.youtube.com/{{$inst->youtube}}" class="yu"><i class="fab fa-youtube"></i></a></li>
                                </ul>
                            </div>
                            <ul class="_bty149">
                                <li>
                                    @if ($inst->ins_sub == 1)
                                    <button class="subscribe-btn bg-light text-dark btn500" 
                                        onclick="window.location.href = '{{ route('unsubscribe',['id'=>$inst->id]) }}';">{{__('Subscribed')}}</button>
                                    @else
                                    <button class="subscribe-btn btn500"
                                        onclick="window.location.href = '{{ route('subscribe',['id'=>$inst->id]) }}';">{{__('Subscribe')}}</button>
                                    @endif
                                </li>
                                <li><button class="msg125 btn500" onclick="window.location.href = '{{ route('stu-message.show',['id'=>$inst->id]) }}';"  >{{__('Message')}}</button></li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="_215b15">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="course_tabs">
                    <nav>
                        <div class="nav nav-tabs tab_crse" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-about-tab" data-toggle="tab" href="#nav-about"
                                role="tab" aria-selected="true">{{__('About')}}</a>
                            <a class="nav-item nav-link" id="nav-courses-tab" data-toggle="tab" href="#nav-courses"
                                role="tab" aria-selected="false">{{__('Courses')}}</a>
                            <a class="nav-item nav-link" id="nav-reviews-tab" data-toggle="tab" href="#nav-reviews"
                                role="tab" aria-selected="false">{{__('Discussion')}}</a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="_215b17">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="course_tab_content">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-about" role="tabpanel">
                            <div class="_htg451">
                                <div class="_htg452">
                                    <h3>{{__('About Me')}}</h3>
                                    <p>{{$inst->description}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-courses" role="tabpanel">
                            <div class="crse_content">
                                <h3>{{__('My courses')}} ({{count($inst->courses)}})</h3>
                                <div class="_14d25">
                                    <div class="row">
                                        @foreach ($inst->courses as $course)
                                        <div class="col-lg-3 col-md-4">
                                            <x-horizontal-courses :course="$course"></x-horizontal-courses>
                                        </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-reviews" role="tabpanel">
                            <div class="student_reviews">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="review_right">
                                            <div class="review_right_heading">
                                                <h3>{{__('Discussions')}}</h3>
                                            </div>
                                        </div>

                                        <div class="cmmnt_1526">
                                            <form action="{{url('instructor-comment')}}" method="POST">
                                                @csrf
                                                <div class="cmnt_group">
                                                    <div class="img160">
                                                        <img src="
                                                    {{ asset(auth('student')->user()->image ?? "default.png") }}"
                                                            alt="">
                                                    </div>
                                                    <input type="hidden" name="instructor_id" value="{{$inst->id}}">
                                                    <textarea class="_cmnt001"
                                                        placeholder="{{__('Add a public comment')}}" required
                                                        name="comment" minlength="20" maxlength="255"></textarea>
                                                </div>
                                                @if(Auth::guard('student')->check())
                                                <button class="cmnt-btn" type="submit">{{__('Comment')}}</button>
                                                @else
                                                <button class="cmnt-btn" href="{{url('login')}}">{{__('Login')}}</button>
                                                @endif
                                            </form>
                                        </div>
                                        <div class="review_all120">
                                            @foreach ($inst->discussions as $item)
                                            <div class="review_item">
                                                <div class="review_usr_dt">
                                                    <img src="{{ asset($item->student->image ?? "No Data") }}" alt="">
                                                    <div class="rv1458">
                                                        <h4 class="tutor_name1">{{$item->student->name ?? "No Data"}}
                                                        </h4>
                                                        <span
                                                            class="time_145">{{$item->created_at->diffForHumans()}}</span>
                                                    </div>
                                                    @if (auth('student')->user() && auth('student')->user()->id == $item->student_id)
                                                    <div class="eps_dots more_dropdown">
                                                        <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                                        <div class="dropdown-content">
                                                            

                                                            <form action="{{ route('ins.dis.destroy', $item) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <a href="#" type="submit"
                                                                    onclick="confirm('{{ __("Are you sure you want to delete this?") }}') ? this.parentElement.submit() : ''"
                                                                    title="Delete"><span><i class='uil uil-trash-alt'></i>{{__('Delete')}}</span></a>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    @endif

                                                </div>
                                                <p class="rvds10">{{$item->comment}}</p>
                                                <div class="rpt101">
                                                    <a href="{{ route('ins.dis.social', ['id'=>$item->id,'action'=>'like']) }}"
                                                        class="report155 {{in_array(auth('student')->user()->id ?? "0",$item->likes) ? 'text-danger' : '' }}"><i
                                                            class='uil uil-thumbs-up'></i>
                                                        {{count($item->likes)}}</a>
                                                    <a href="{{ route('ins.dis.social', ['id'=>$item->id,'action'=>'dislike']) }}"
                                                        class="report155 {{in_array(auth('student')->user()->id ?? "0",$item->dislikes) ? 'text-danger' : ''}}"><i
                                                            class='uil uil-thumbs-down'></i>
                                                        {{count($item->dislikes)}}</a>

                                                </div>
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