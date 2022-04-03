@extends('layouts.admin-master')

@section('title')
{{ __('Courses') }}
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{ __('Courses') }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">{{ __('Home') }}</a></div>
            <div class="breadcrumb-item"><a href="#">{{ __('Courses') }}</a></div>
            <div class="breadcrumb-item"><a href="#">{{ __('Detail') }}</a></div>
        </div>
    </div>
    <div class="section-body">

        <x-alert-msg></x-alert-msg>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                        <article class="article article-style-c">
                            <div class="article-header">
                                <div class="article-image" data-background="{{ asset($course->cover_image) }}"
                                    style="background-image: url({{ asset($course->cover_image) }});">
                                </div>
                                <div class="article-badge d-flex">
                                    @if ($course->is_featured)
                                    <div class="article-badge-item bg-danger mr-1"><i class="fas fa-fire"></i>
                                        {{__('Featured')}}
                                    </div>
                                    @endif
                                    @if ($course->is_bestseller)
                                    <div class="article-badge-item bg-warning mr-1"><i class="fas fa-fire"></i>
                                        {{__('Bestseller')}}
                                    </div>
                                    @endif
                                    <div class="article-badge-item bg-dark"><i
                                            class="fas fa-fire"></i>{{$course->status($course->status)}}</div>
                                </div>
                            </div>
                            <div class="article-details">
                                <div class="article-category"><a href="#">{{$course->category->name ?? "No Data"}}</a>
                                    <div class="bullet"></div> <a
                                        href="#">{{$course->subCategory->name ?? "No Data"}}</a>
                                </div>
                                <div class="article-title">
                                    <h2><a href="#">{{$course->title}}</a></h2>
                                </div>
                                <p>{{$course->subtitle}}</p>

                                <div class="article-user">
                                    <img alt="image" src="{{ asset($course->instructor->image ?? "No Data") }}">
                                    <div class="article-user-details">
                                        <div class="user-detail-name">
                                            <a href="#">{{$course->instructor->name ?? "No Data"}}</a>
                                        </div>
                                        <div class="text-job">{{$course->instructor->email ?? "No Data"}}</div>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <div class="card mt-4">
                            <div class="card-header">
                                <h4>{{__('Extra Details')}}</h4>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled user-details list-unstyled-border list-unstyled-noborder">
                                    <li class="media">

                                        <div class="media-items">
                                            <div class="media-item">
                                                <div class="media-value">{{$course->views}}</div>
                                                <div class="media-label">{{__('Views')}}</div>
                                            </div>
                                            <div class="media-item">
                                                <div class="media-value">{{$course->likes}}</div>
                                                <div class="media-label">{{__('Likes')}}</div>
                                            </div>
                                            <div class="media-item">
                                                <div class="media-value">{{$course->dislikes}}</div>
                                                <div class="media-label">{{__('Dis-Likes')}}</div>
                                            </div>
                                            <div class="media-item">
                                                <div class="media-value">{{$course->share}}</div>
                                                <div class="media-label">{{__('Share')}}</div>
                                            </div>
                                            <div class="media-item">
                                                <div class="media-value">{{$course->report_abues}}</div>
                                                <div class="media-label">{{__('Report')}}</div>
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-9">

                        <div class="row mb-2">
                            <div class="col-12">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home"
                                            role="tab" aria-controls="home" aria-selected="true">{{__('About')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile"
                                            role="tab" aria-controls="profile"
                                            aria-selected="false">{{__('Courses Content')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " id="contact-tab" data-toggle="tab" href="#contact"
                                            role="tab" aria-controls="contact"
                                            aria-selected="false">{{__('Reviews')}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                {!! clean($course->description)!!}
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    @foreach ($course->content as $item)

                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>{{$item->title}}</h4>
                                            </div>
                                            <div class="card-body">
                                                <div id="accordion{{$item->id}}">
                                                    @foreach ($item->lectures as $les)

                                                    <div class="accordion">
                                                        <div class="accordion-header collapsed" role="button"
                                                            data-toggle="collapse"
                                                            data-target="#panel-body-{{$les->id}}"
                                                            aria-expanded="false">
                                                            <h4>{{$les->title}}</h4>
                                                        </div>
                                                        <div class="accordion-body collapse"
                                                            id="panel-body-{{$les->id}}"
                                                            data-parent="#accordion{{$item->id}}">
                                                            <p class="mb-0">
                                                                <ul class="list-unstyled list-unstyled-border">
                                                                    <li class="media">

                                                                        <div class="media-body">
                                                                            <div class="media-right"> <a
                                                                                    href="{{ asset($course->cover_image) }}"
                                                                                    target="_blank">{{__('View')}}</a>
                                                                            </div>
                                                                            <div class="media-title"><a
                                                                                    href="#">{{$les->title}}</a></div>
                                                                            <div class="text-small text-muted"> <a
                                                                                    href="#">{{$les->volume}} MB</a>
                                                                                <div class="bullet"></div>
                                                                                {{$les->duration}} Min
                                                                            </div>
                                                                        </div>
                                                                    </li>

                                                                </ul>
                                                                {!! clean($les->description)!!}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade " id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>{{__('Comments')}}</h4>
                                            </div>
                                            <div class="card-body">
                                                <ul class="list-unstyled list-unstyled-border list-unstyled-noborder">
                                                    @foreach ($course->reviews as $review)
                                                    <li class="media">
                                                        <img alt="image" class="mr-3 rounded-circle" width="70"
                                                            src="{{ asset($review->student->image ?? 'default.png') }}">
                                                        <div class="media-body">
                                                            <div class="media-right">
                                                                <div class="product-review">

                                                                    @for ($i = 0; $i < 5;$i++) <i
                                                                        class="{{$review->star > $i ? 'fas' : 'far'}} fa-star">
                                                                        </i>

                                                                        @endfor
                                                                </div>
                                                            </div>
                                                            <div class="media-title mb-1">
                                                                {{$review->student->name ?? 'No Data'}}</div>
                                                            <div class="text-time">
                                                                {{$review->updated_at->diffForHumans()}}</div>
                                                            <div class="media-description text-muted">{{$review->msg}}
                                                            </div>
                                                            <div class="media-links">

                                                                <a href="{{ route('admin-review.delete', ['id'=>$review->id]) }}"
                                                                    class="text-danger">{{__('Trash')}}</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @endforeach

                                                </ul>
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
</section>
@endsection