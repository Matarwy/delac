@extends('frontend.layouts.ins-master')

@section('content')

<div class="_215v12">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="section3125">
                    <div class="row justify-content-md-center">
                        <div class="col-md-6">
                            <div class="help_stitle">
                                <h2>{{__('How may we help you?')}}</h2>
                                <div class="explore_search">
                                    <div class="ui search focus">
                                        @if (request()->is('help'))

                                        <form action="{{url("help")}}" method="post" enctype="multipart/form-data">
                                            @else
                                            <form action="{{url("instructor/help")}}" method="post"
                                                enctype="multipart/form-data">

                                                @endif
                                                <div class="ui left icon input swdh11">
                                                    @csrf
                                                    <input class="prompt srch_explore" type="text"
                                                        placeholder="{{__('Search for solutions')}}" name="q" value="{{$q}}">
                                                    <i class="uil uil-search-alt icon icon2"></i>
                                                </div>
                                            </form>
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
<div class="_215b15">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="course_tabs">
                    <nav>
                        <div class="nav nav-tabs help_tabs tab_crse justify-content-center" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-instructor-tab" data-toggle="tab"
                                href="#nav-instructor" role="tab" aria-selected="true">{{__('Instructor')}}</a>
                            <a class="nav-item nav-link" id="nav-student-tab" data-toggle="tab" href="#nav-student"
                                role="tab" aria-selected="false">{{__('Student')}}</a>
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
                        <div class="tab-pane fade show active" id="nav-instructor" role="tabpanel">
                            <div class="tpc152">
                                <div class="crse_content">
                                    <h3>{{__('Select a topic to search for help')}}</h3>
                                </div>
                                <div class="section3126 mt-20">
                                    <div class="row">
                                        @foreach ($master['ins'] as $item)

                                        <div class="col-md-4">
                                            <a href="#" class="value_props50">

                                                <div class="value_content">
                                                    <h4 class="text-left">{{$item->question}}</h4>
                                                    <p class="text-left">{{$item->ans}}</p>
                                                </div>
                                            </a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="nav-student" role="tabpanel">
                            <div class="tpc152">
                                <div class="crse_content">
                                    <h3>{{__('Select a topic to search for help')}}</h3>
                                </div>
                                <div class="section3126 mt-20">
                                    <div class="row">
                                        @foreach ($master['stu'] as $item)

                                        <div class="col-md-4">
                                            <a href="#" class="value_props50">

                                                <div class="value_content">
                                                    <h4 class="text-left">{{$item->question}}</h4>
                                                    <p class="text-left">{{$item->ans}}</p>
                                                </div>
                                            </a>
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
@endsection