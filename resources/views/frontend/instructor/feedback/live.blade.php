@extends('frontend.layouts.ins-master')

@section('content')
<div class="row justify-content-md-center">
    <div class="col-lg-8 col-md-10">

        @if (Auth::user()->is_live == 0)
        <div class="add_stream_content">
            <h4 class="strm_title">{{__('Connect your live stream to the Live API')}}</h4>
            <div class="sf475">{{__('Use live-streaming software or a hardware encoder.')}} <a
                    href="https://motioncue.com/3-simple-steps-to-embed-live-stream-video-to-your-website/"
                    target="_blank">{{__('Learn More')}}</a>
            </div>
            <div class="stm_key">{{__('Preview your broadcast with a stream key or paired encoder.')}}</div>
            <form action="{{ route('live-stream.store') }}" method="post">

                @csrf
                <div class="live_form">
                    <div class="group-form">
                        <label>{{__('Embed Code')}}*</label>
                        <input class="_dlor1" type="text" placeholder="{{__("Stream URL Embed Code")}}" required minlength="5">

                    </div>
                    <div class="ui toggle checkbox _1457s2">
                        <input type="checkbox" name="enable_comment" tabindex="0" class="hidden" value="1" checked>
                        <label>{{__('Turn on live comment')}}</label>
                    </div>
                   
                    <button class="_145d1" type="submit"><i class="uil uil-video"></i>{{__('Go Live')}}</button>
                </div>
            </form>
        </div>
        @else
        <div class="add_stream_content">
            <h4 class="strm_title">{{__('You are live now ')}}</h4>
            <button class="_145d1" type="submit" onclick="window.location.href = '{{ route('live-stream.end') }}';"><i
                    class="uil uil-video"></i>{{__('End Your Live')}}</button>
            <p>{{__('open link in ignogito tab or new browser')}}</p>
            <a
                href="{{ route('live.show', ['id'=>Auth::id(),'slug'=>  str_replace(' ', '-', strtolower(Auth::user()->name))]) }}">{{__('View Stream')}}</a>
        </div>
        @endif



    </div>

</div>

@endsection