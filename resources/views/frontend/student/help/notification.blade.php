@extends('frontend.layouts.ins-master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2 class="st_title"><i class="uil uil-bell"></i> {{__('Notifications')}}</h2>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="all_msg_bg">
            @foreach ($noti as $n)
            <div class="channel_my item all__noti5">
                <div class="profile_link">
                    <div id="noti-avtar"
                        class="bg-danger text-white">{{substr($n->title, 0, 1)}}</div>
                    <div class="pd_content">
                        <p class="noti__text5">{{$n->title}}
                        </p>
                        <span class="nm_time">{{$n->created_at->diffForHumans()}}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection