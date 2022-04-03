@extends('frontend.layouts.ins-master')
@section('content')
<div class="row">
    <div class="col-lg-3 col-md-4 ">
        <div class="section3125 hstry142">
            <div class="grp_titles pt-0">
                <div class="ht_title">{{__('Buy Courses')}}</div>

            </div>
            <div class="tb_145">
                <div class="wtch125">
                    <span class="vdt14">{{count($orders)}} {{__('Buy Courses')}}</span>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="_14d25 mb-20">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="mhs_title">{{__('Buy Courses')}}</h4>
                    @forelse ($orders as $order)
                    <div class="fcrse_1 mb-30">
                        <a href="{{ route('courseShow', ['slug'=> str_replace(' ', '-', strtolower($order->course->title)),'id' => $order->course->id]) }}"
                            class="hf_img">
                            <img src="{{ asset($order->course->cover_image) }}" alt="">
                            <div class="course-overlay">
                                @if ($order->course->is_bestseller == 1)
                                <div class="badge_seller">{{__('Bestseller')}}</div>
                                @endif
                                @if ($order->course->avg_rating > 0)
                                <div class="crse_reviews">
                                    <i class="uil uil-star"></i>{{$order->course->avg_rating}}
                                </div>
                                @endif

                                <span class="play_btn1"><i class="uil uil-play"></i></span>
                                <div class="crse_timer">
                                    {{floor($order->course->duration / 60)}} {{__('hours')}}
                                </div>
                            </div>
                        </a>
                        <div class="hs_content">
                            <div class="eps_dots eps_dots10 more_dropdown">
                                <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                <div class="dropdown-content">
                                    <a href="{{ route('order.invoice', ['id'=>$order->id]) }}" target="_blank"><span><i
                                                class='uil uil-print'></i>{{__('Invoice')}}</span></a>
                                </div>
                            </div>
                            <div class="vdtodt">
                                <span class="vdt14">{{$order->course->shortNumber($order->course->views)}}
                                    {{__('views')}}</span>
                                <span class="vdt14">{{$order->course->created_at->diffForHumans()}}</span>
                            </div>
                            <a href="{{ route('courseShow', ['slug'=> str_replace(' ', '-', strtolower($order->course->title)),'id' => $order->course->id]) }}"
                                class="crse14s title900">{{$order->course->title}}</a>
                            <a href="#" class="crse-cate">{{$order->course->category->name ?? "No Data"}} |
                                {{$order->course->subCategory->name ?? "No Data"}}</a>
                            <div class="auth1lnkprce">
                                <p class="cr1fot">{{__('By')}} <a
                                        href="#">{{$order->course->instructor->name ?? "No Data"}}</a>
                                </p>
                                <div class="prce142">{{$admin_setting[7]['value']}}{{ number_format($order->price, 2)}}
                                </div>


                            </div>
                            <div class="auth1lnkprce">
                                <p class="cr1fot">{{__('buy at')}} {{$order->created_at->format('d M,Y') }}
                                </p>
                            </div>
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