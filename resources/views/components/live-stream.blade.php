<div class="item">
    <div class="stream_1">
        <a href="{{ route('live.show', ['id'=>$stream->id,'slug'=>  str_replace(' ', '-', strtolower($stream->name))]) }}" class="stream_bg">
            <img src="{{ asset($stream->image) }}" alt="">
            <h4>{{$stream->name}}</h4>
            <p>{{__('live')}}<span></span></p>
        </a>
    </div>
</div>