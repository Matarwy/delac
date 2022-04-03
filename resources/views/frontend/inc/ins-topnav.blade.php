<header class="header clearfix">
    <button type="button" id="toggleMenu" class="toggle_menu">
        <i class='uil uil-bars'></i>
    </button>
    <button id="collapse_menu" class="collapse_menu">
        <i class="uil uil-bars collapse_menu--icon "></i>
        <span class="collapse_menu--label"></span>
    </button>
    <div class="main_logo" id="logo">
        <a href="{{route('ins-home')}}"><img src="{{ asset('frontend/images/logo.svg ')}}" alt=""></a>
        <a href="{{route('ins-home')}}"><img class="logo-inverse" src="{{ asset('frontend/images/ct_logo.svg')}}" alt=""></a>
    </div>
    <div class="top-category">
        
    </div>
    <div class="search120">
       
    </div>
    <div class="header_right">
        <ul>
            <li>
                <a href="{{ route('courses.create') }}" class="upload_btn"
                    title="{{__('Create New   Course')}}">{{__('Create New   Course')}}</a>
            </li>
        @if(Auth::guard('instructor')->check())
        @php
        $nl = Auth::guard('instructor')->user()->notifications->take(5);
        $nc= count($nl);
        $lc=Auth::guard('instructor')->user()->latestChat->take(5);
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
                <a class="vbm_btn" href="{{ route('ins-messages') }}">{{__('View All')}} <i class='uil uil-arrow-right'></i></a>
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
            
            
                    <a class="vbm_btn" href="{{route('ins-notification')}}">View All <i class='uil uil-arrow-right'></i></a>
                </div>
            </li>
            <li class="ui dropdown">
                <a href="#" class="opts_account" title="Account">
                    <img src="{{ asset('frontend/images/hd_dp.jpg')}}" alt="">
                </a>
                <div class="menu dropdown_account">
                    <div class="channel_my">
                        <div class="profile_link">
                            <img src="{{ asset('frontend/images/hd_dp.jpg')}}" alt="">
                            <div class="pd_content">
                                <div class="rhte85">
                                    <h6>{{auth()->user()->name ?? ""}}</h6>
                                    @if (auth()->user()->verify_pro == 1)
                                    <div class="mef78" title="Verify">
                                        <i class='uil uil-check-circle'></i>
                                    </div>
                                    @endif
                                </div>
                                <span>{{auth()->user()->email}}</span>
                            </div>
                        </div>
                  
                    </div>
                    <div class="night_mode_switch__btn">
                        <a href="#" id="night-mode" class="btn-night-mode">
                            <i class="uil uil-moon"></i>{{__(' Night mode')}}
                            <span class="btn-night-mode-switch">
                                <span class="uk-switch-button"></span>
                            </span>
                        </a>
                    </div>
                    <a href="{{ route('ins-home') }}" class="item channel_item">{{__('Dashboard')}}</a>

                    <a href="{{ route('profile.edit') }}" class="item channel_item">{{__('Setting')}}</a>
                    <a href="{{ url('instructor/help') }}" class="item channel_item">{{__('Help')}}</a>
                    <a href="{{ url('instructor/feedback') }}" class="item channel_item">{{__('Send Feedback')}}</a>
                    <a href="{{ route('ins.logout') }}" class="item channel_item">{{__('Sign Out')}}</a>
                </div>
            </li>
        </ul>
    </div>
</header>