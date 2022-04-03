<header class="header clearfix">
    <button type="button" id="toggleMenu" class="toggle_menu">
        <i class='uil uil-bars'></i>
    </button>
    <button id="collapse_menu" class="collapse_menu">
        <i class="uil uil-bars collapse_menu--icon "></i>
        <span class="collapse_menu--label"></span>
    </button>
    <div class="main_logo" id="logo">
        <a href="{{url('/')}}"><img src="{{ asset('frontend/images/logo.svg')}}" alt=""></a>
        <a href="{{url('/')}}"><img class="logo-inverse" src="{{ asset('frontend/images/ct_logo.svg')}}" alt=""></a>
    </div>
    <div class="top-category">
        <div class="ui compact menu cate-dpdwn">
            <div class="ui simple dropdown item">
                <a href="#" class="option_links p-0" title="categories"><i class="uil uil-apps"></i></a>
                <div class="menu dropdown_category5">
               
                    @foreach($categorys as $cat)
                    <a href="{{ route('categoriesCourses',['slug'=> str_replace(' ', '-', strtolower($cat->name)),'id' => $cat->id]) }}"
                        class="item channel_item">{{$cat->name}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="search120">
        <div class="ui search">
            <form action="{{ route('explore') }}" method="post">
                @csrf
                <div class="ui left icon input swdh10">
                    <input class="prompt srch10" type="text"
                        placeholder="{{__('Search for Tuts Videos, Tutors, Tests and more..')}}" name="q">
                    <i class='uil uil-search-alt icon icon1'></i>
                </div>
            </form>
        </div>
    </div>
    <div class="header_right">
        <ul>
            @if(Auth::guard('student')->check())
            <li>
                <a href="{{ route('order.index') }}" class="upload_btn" title="Create New Course">{{__('Enrolled')}}</a>
            </li>
            @else
            <li>
                <a href="{{ url('login') }}" class="upload_btn" title="Create New Course">{{__('Login')}}</a>
            </li>
            @endif
            <li>
                <a href="{{ url('cart') }}" class="option_links" title="cart"><i
                        class='uil uil-shopping-cart-alt'></i><span
                        class="noti_count">@if(Auth::guard('student')->check()){{Auth::guard('student')->user()->loadCount('cart')->cart_count}}@else
                        0 @endif</span></a>
            </li>
            @if(Auth::guard('student')->check())
            @php
            $nl = Auth::guard('student')->user()->notifications->take(5);
            $nc= count($nl);
            $lc=Auth::guard('student')->user()->latestChat->take(5);
            $lcc=count($lc);
            @endphp
            @else
            @php
            $nc = 0;
            $nl = [];
            $lcc = 0;
            $lc = [];
            @endphp
            @endif
            <li class="ui dropdown">
                <a href="#" class="option_links" title="Messages"><i class='uil uil-envelope-alt'></i><span
                        class="noti_count">{{$lcc}}</span></a>
                <div class="menu dropdown_ms">
                    @forelse ($lc as $ch)

                    <a href="#" class="channel_my item">
                        <div class="profile_link">
                            <img src="{{ asset($d->user->image ?? "default.png") }}" alt="">
                            <div class="pd_content">
                                <h6>{{$ch->user->name ?? "No Data"}}</h6>
                                <p>{{$ch->last_msg}}</p>
                                <span class="nm_time">{{$ch->last_chat->diffForHumans()}}</span>
                            </div>
                        </div>
                    </a>
                    @empty
                    <a href="#" class="channel_my item">
                        <div class="profile_link">

                            <div class="pd_content">

                                <p>{{__('No Chat')}}</strong>.</p>
                                <span class="nm_time">{{__('Ones upon time')}}</span>
                            </div>
                        </div>
                    </a>
                    @endforelse
                    <a class="vbm_btn" href="{{ route('stu-messages') }}">{{__('View All')}} <i
                            class='uil uil-arrow-right'></i></a>
                </div>
            </li>

            <li class="ui dropdown">
                <a href="#" class="option_links" title="Notifications"><i class='uil uil-bell'></i><span
                        class="noti_count">{{$nc}}</span></a>
                <div class="menu dropdown_mn">
                    @forelse ($nl as $item)
                    <a href="#" class="channel_my item">
                        <div class="profile_link">

                            <div class="pd_content">

                                <p>{{$item->title}}</p>
                                <span class="nm_time">{{$item->created_at->diffForHumans()}}</span>
                            </div>
                        </div>
                    </a>
                    @empty
                    <a href="#" class="channel_my item">
                        <div class="profile_link">

                            <div class="pd_content">

                                <p>{{__('No Notifications')}}</strong>.</p>
                                <span class="nm_time">{{__('Ones upon time')}}</span>
                            </div>
                        </div>
                    </a>
                    @endforelse


                    <a class="vbm_btn" href="{{ url('notifications') }}">{{__('View All')}} <i
                            class='uil uil-arrow-right'></i></a>
                </div>
            </li>
            <li class="ui dropdown">
                <a href="#" class="opts_account" title="Account">
                    <img src="{{ asset('frontend/images/hd_dp.jpg') }}" alt="">
                </a>
                <div class="menu dropdown_account">
                    <div class="channel_my">
                        <div class="profile_link">
                            <img src="{{ asset('frontend/images/hd_dp.jpg') }}" alt="">
                            <div class="pd_content">
                                <div class="rhte85">
                                    <h6>{{auth('student')->user()->name ?? "Guest"}}</h6>
                                    @if (auth('student')->user()->email_verified_at ?? false)
                                        <div class="mef78" title="Verify">
                                            <i class='uil uil-check-circle'></i>
                                        </div>
                                    @endif
                                </div>
                               <span>{{auth('student')->user()->email ?? "Please Login to your account"}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="night_mode_switch__btn">
                        <a href="#" id="night-mode" class="btn-night-mode">
                            <i class="uil uil-moon"></i> {{__('Night mode')}}
                            <span class="btn-night-mode-switch">
                                <span class="uk-switch-button"></span>
                            </span>
                        </a>
                    </div>
                    @if(Auth::guard('student')->check())

                    <a href="{{ route('subscription') }}" class="item channel_item">{{__('Subscription')}}</a>
                    <a href="{{ route('profile.editstu') }}" class="item channel_item">{{__('Setting')}}</a>
                    <a href="{{ url('help') }}" class="item channel_item">{{__('Help')}}</a>
                    <a href="{{ url('feedback') }}" class="item channel_item">{{__('Send Feedback')}}</a>

                    <a href="{{ route('stu.logout') }}" class="item channel_item">{{__('Sign Out')}}</a>
                    @else
                    <a href="{{ url('login') }}" class="item channel_item">{{__('Sign in')}}</a>
                    <a href="{{ url('register') }}" class="item channel_item">{{__('Sign Up')}}</a>

                    @endif

                </div>
            </li>
        </ul>
    </div>
</header>