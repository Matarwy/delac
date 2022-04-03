@extends('layouts.admin-master')

@section('title')
{{ __('Students') }}
@endsection

@section('content')

<section class="section">
    <div class="section-header">
        <h1>{{ __('Students') }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">{{ __('Home') }}</a></div>
            <div class="breadcrumb-item"><a href="#">{{ __('Students') }}</a></div>
        </div>
    </div>

    <div class="section-body">
        <x-alert-msg></x-alert-msg>
        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-5">
                <div class="card profile-widget">
                    <div class="profile-widget-header">
                        <img alt="image" src="{{ asset($student->image) }}"
                            class="rounded-circle profile-widget-picture">
                        <div class="profile-widget-items">
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">{{__('Enroll Course')}}</div>
                                <div class="profile-widget-item-value">
                                    {{$student->enroll_count}}</div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">{{__('Subscriptions')}}</div>
                                <div class="profile-widget-item-value">
                                    {{$student->subscriptions_count}}</div>
                            </div>

                        </div>
                    </div>
                    <div class="profile-widget-description">
                        <div class="profile-widget-name">{{$student->name}}

                            <div class="text-muted d-inline font-weight-normal">
                                <div class="slash"></div> {{$student->email}}
                            </div>
                        </div>

                    </div>

                    <div class="card-footer text-center">
                        <div class="font-weight-bold mb-2">{{__('Extra Detail')}}</div>


                        @if ($student->status == 1)
                        <span class="badge badge-light">{{__('Active')}}</span>
                        @else
                        <span class="badge badge-warning">{{__('Block')}}</span>
                        @endif
                    </div>
                </div>
                <div class="row">

                    <div class="col-12 col-sm-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{__('Comments')}}</h4>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled list-unstyled-border list-unstyled-noborder">
                                    @foreach ($student->reviews as $review)
                                    <li class="media">
                                        <img alt="image" class="mr-3 rounded-circle" width="70" height="70"
                                            src="{{ asset($review->course->cover_image ?? 'default.png') }}">
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
                                                {{$review->course->title ?? 'No Data'}}</div>
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
            <div class="col-12 col-md-12 col-lg-7">
                <div class="card">

                    <div class="card-header">
                        <h4>{{__('Course')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped  no-footer">
                                <thead>
                                    <tr>
                                        <th>
                                            {{__(' #')}}
                                        </th>
                                        <th>
                                            {{__('Title')}}
                                        </th>
                                        <th>
                                            {{__('instructor Name')}}
                                        </th>
                                        <th>
                                            {{__('Price')}}
                                        </th>

                                        <th>
                                            {{__('Buy at')}}
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($student->enroll ?? [] as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $item->course->title}}


                                        </td>
                                        <td>{{ $item->course->instructor->name ?? "No Data"}}</td>
                                        <td>{{ $item->price}}</td>


                                        <td>{{$item->created_at->format('d M Y')}}</td>



                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>{{__('Discussions')}}</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled list-unstyled-border list-unstyled-noborder">
                            @foreach ($student->discussions as $item)
                            <li class="media">
                                <img alt="image" class="mr-3 rounded-circle" width="70"
                                    src="{{ asset($item->instructor->image ?? "No Data") }}">
                                <div class="media-body">
                                    <div class="media-right">
                                    </div>
                                    <div class="media-title mb-1">{{$item->instructor->name ?? "No Data"}}</div>
                                    <div class="text-time">{{$item->created_at->diffForHumans()}}</div>
                                    <div class="media-description text-muted">{{$item->comment}}</div>
                                    <div class="media-links">
                                        <a href="#">Like {{count($item->likes)}}</a>
                                        <div class="bullet"></div>
                                        <a href="#" class="text-danger">Dis-Like {{count($item->dislikes)}}</a>
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
</section>
@endsection