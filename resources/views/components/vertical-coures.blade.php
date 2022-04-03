<div class="fcrse_1 mb-30">
    <a href="{{ route('courseShow', ['slug'=> str_replace(' ', '-', strtolower($course->title)),'id' => $course->id]) }}"
        class="hf_img">
        <img src="{{ asset($course->cover_image) }}" alt="">
        <div class="course-overlay">
            @if ($course->is_bestseller == 1)
            <div class="badge_seller">{{__('Bestseller')}}</div>
            @endif
            @if ($course->avg_rating > 0)
            <div class="crse_reviews">
                <i class="uil uil-star"></i>{{$course->avg_rating}}
            </div>
            @endif

            <span class="play_btn1"><i class="uil uil-play"></i></span>
            <div class="crse_timer">
                {{floor($course->duration / 60)}} {{__('hours')}}
            </div>
        </div>
    </a>
    <div class="hs_content">
        <div class="eps_dots eps_dots10 more_dropdown">
            <a href="{{route('removefromsave',['id'=>$course->id])}}"><i class="uil uil-ellipsis-v"></i></a>
            <div class="dropdown-content">
                <span><i class='uil uil-times'></i>{{__('Remove')}}</span>
            </div>
        </div>
        <div class="vdtodt">
            <span class="vdt14">{{$course->shortNumber($course->views)}} {{__('views')}}</span>
            <span class="vdt14">{{$course->created_at->diffForHumans()}}</span>
        </div>
        <a href="{{ route('courseShow', ['slug'=> str_replace(' ', '-', strtolower($course->title)),'id' => $course->id]) }}"
            class="crse14s title900">{{$course->title}}</a>
        <a href="#" class="crse-cate">{{$course->category->name ?? "No Data"}} |
            {{$course->subCategory->name ?? "No Data"}}</a>
        <div class="auth1lnkprce">
            <p class="cr1fot">{{__('By')}} <a href="#">{{$course->instructor->name ?? "No Data"}}</a></p>
            <div class="prce142">{{$admin_setting[7]['value']}}{{$course->real_price}}</div>

            @if ($course->isbuy == 0)
            <button onclick="window.location.href = '{{ route('addtocart',['id'=>$course->id]) }}';"
                class="shrt-cart-btn" title="cart"><i class="uil uil-shopping-cart-alt"></i></button>
            @else
            <button class="shrt-cart-btn text-success" title="cart"><i class="uil uil-bag"></i></button>
            @endif
        </div>
    </div>
</div>