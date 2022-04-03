@extends('frontend.layouts.ins-master')
@section('content')
<div class="row">
    <div class="col-xl-8 col-lg-8">
        <div class="section3125">
            <div class="live1452">
                {!!clean($live->embed_code)!!}
            </div>
            <div class="user_dt5">
                <div class="user_dt_left">
                    <div class="live_user_dt">
                        <div class="user_img5">
                            <img src="{{ asset($inst->image) }}" alt="">
                        </div>
                        <div class="user_cntnt">
                            <h4>{{$inst->name}}</h4>
                            @if ($inst->ins_sub == 1)
                            <button class="subscribe-btn bg-light text-dark"
                                onclick="window.location.href = '{{ route('unsubscribe',['id'=>$inst->id]) }}';">{{__('Subscribed')}}</button>
                            @else
                            <button class="subscribe-btn"
                                onclick="window.location.href = '{{ route('subscribe',['id'=>$inst->id]) }}';">{{__('Subscribe')}}</button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="user_dt_right">
                    <ul>
                        <li>
                            <a href="#" class="lkcm152"><i
                                    class='uil uil-eye'></i><span>{{$live->shortNumber($live->views)}}</span></a>
                        </li>
                        <li>

                            <a href="{{ route('stream.likedislike', ['id'=>$live->id,'action'=>'likes']) }}" class="lkcm152 {{in_array(auth('student')->user()->id ?? "0",$live->likes ?? []) ? 'text-danger' : ''}}
                                "><i
                                    class='uil uil-thumbs-up'></i><span>{{$live->shortNumber(count($live->likes ?? []))}}</span></a>
                        </li>
                        <li>
                            <a href="{{ route('stream.likedislike', ['id'=>$live->id,'action'=>'dislikes']) }}" class="lkcm152 {{in_array(auth('student')->user()->id ?? "0",$live->dislikes ?? []) ? 'text-danger' : ''}}
                                "><i
                                    class='uil uil-thumbs-down'></i><span>{{$live->shortNumber(count($live->dislikes ?? []))}}</span></a>
                        </li>
                        <li>
                            <a target="popup"
                                onclick="window.open('{{ route('stream.share', ['slug'=> str_replace(' ', '-', strtolower($inst->name)),'id' => $live->id]) }}','popup','width=600,height=600,scrollbars=no,resizable=no'); return false;"
                                class="lkcm152"><i
                                    class='uil uil-share-alt'></i><span>{{$live->shortNumber($live->share)}}</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4">
        <div class="right_side">
            <div class="fcrse_3">
                <div class="cater_ttle">
                    <h4>{{__('Live Chat')}}</h4>
                </div>
                <div class="live_chat">
                    <div class="chat1" id="chat1">
                        @foreach ($comments as $com)
                        <p><a href="#">{{$com->student->name ?? "NO Data"}}</a>{{$com->msg}}</p>
                        @if ($loop->last)
                        <input type="hidden" name="lastcmt" id="lastcmt" value="{{$com->id}}">
                        @endif
                        @endforeach

                    </div>
                </div>
                <div class="live_comment">
                    @if ($live->enable_comment == 1)

                    <input class="live_input" id="msg" type="text" placeholder="{{__('Say Something...')}}" />
                    <input name="student_id" id="student_id" type="hidden"
                        value="{{auth('student')->user()->id ?? 0}}" />
                    <input name="stream_id" id="stream_id" type="hidden" value="{{$live->id}}" />
                    <button class="btn_live" onclick="addComment()" {{auth('student')->user() ? "" : "disabled"}}><i
                            class='uil uil-message'></i></button>
                    @else
                    <input class="live_input" id="msg" type="text" placeholder="{{__('Live Chat is disable.')}}"
                        readonly />
                    <button class="btn_live" disabled><i class='uil uil-message'></i></button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="section3125 mb-15 mt-20">
            <h4 class="item_title">{{__('Live Streams')}}</h4>
            <a href="{{ route('live.index') }}" class="see150">{{__('See all')}}</a>
            <div class="la5lo1">
                <div class="owl-carousel live_stream owl-theme">
                    @foreach($livestreams as $stream)
                    <div class="item">
                        <x-live-stream :stream="$stream"></x-live-stream>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    "use strict";
    $(document).ready(function() {
    const livechat ="{{$live->enable_comment}}";

    if(livechat == 1){

        setInterval(() => {
            getComments();
        }, 5000);
    }
    })
  function  addComment(){
            var formData = {
                stream_id:$("#stream_id").val(),
                student_id:$("#student_id").val(),
                 msg:$("#msg").val()
                }; 
    $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    url : "{{route('stream.comment')}}",
    type: "POST", 
    data : formData, 
    async : false,
    success: function(response, textStatus, jqXHR) {
    
    $("#msg").val("")
    getComments();

    },
    error: function (jqXHR, textStatus, errorThrown) {
    
    
    
    }
    });
    }
    function getComments(){

        var formData = {
        lastcmt:$("#lastcmt").val(),
        stream_id:$("#stream_id").val(),
        };
        $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : "{{route('stream.comment.ajax')}}",
        type: "POST",
        data : formData,
        async : false,
        success: function(response, textStatus, jqXHR) {
        
        $("#chat1").append(response.data);
        
        
        $("#chat1").animate({ scrollTop: $('#chat1').prop("scrollHeight")}, 1000);
       
       $("#lastcmt").val(response.lastcmtid)
        },
        error: function (jqXHR, textStatus, errorThrown) {
        
        
        
        }
        });
    }
</script>
@endpush