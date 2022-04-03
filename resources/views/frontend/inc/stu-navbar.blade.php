<nav class="vertical_nav">
    <div class="left_section menu_left" id="js-menu">
        <div class="left_section">
            <ul>
                <li class="menu--item">
                    <a href="{{ url('/') }}" class="menu--link {{request()->is('/') ? 'active' : ''}}" title="Home">
                        <i class='uil uil-home-alt menu--icon'></i>
                        <span class="menu--label">{{__('Home')}}</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{ route('live.index') }}" class="menu--link {{request()->is('live') ? 'active' : ''}}"
                        title="Live Streams">
                        <i class='uil uil-kayak menu--icon'></i>
                        <span class="menu--label">{{__('Live Streams')}}</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{ route('explore') }}" class="menu--link {{request()->is('explore') ? 'active' : ''}}"
                        title="Explore">
                        <i class='uil uil-search menu--icon'></i>
                        <span class="menu--label">{{__('Explore')}}</span>
                    </a>
                </li>
                <li
                    class="menu--item menu--item__has_sub_menu {{request()->is('categories/*') ? 'menu--subitens__opened' : ''}}">
                    <label class="menu--link" title="Categories">
                        <i class='uil uil-layers menu--icon'></i>
                        <span class="menu--label">{{__('Categories')}}</span>
                    </label>
                    <ul class="sub_menu">
                        @foreach($categorys as $cat)
                        <li class="sub_menu--item">
                            <a href="{{ route('categoriesCourses',['slug'=> str_replace(' ', '-', strtolower($cat->name)),'id' => $cat->id]) }}"
                                class="sub_menu--link">{{$cat->name}}</a>
                        </li>
                        @endforeach


                    </ul>
                </li>
                
                <li class="menu--item">
                    <a href="{{ route('saved-course') }}"
                        class="menu--link {{request()->is('saved-course') ? 'active' : ''}}" title="Saved Courses">
                        <i class="uil uil-heart-alt menu--icon"></i>
                        <span class="menu--label">{{__('Saved Courses')}}</span>
                    </a>
                </li>

                <li class="menu--item">
                    <a href="{{ url('filter') }}" class="menu--link {{request()->is('filter') ? 'active' : ''}}"
                        title="Saved Courses">
                        <i class="uil uil-abacus menu--icon"></i>
                        <span class="menu--label">{{__('Filter')}}</span>
                    </a>
                </li>
                @if(Auth::guard('student')->check())
                <li class="menu--item">
                    <a href="{{ route('order.index') }}" class="menu--link {{request()->is('order*') ? 'active' : ''}}"
                        title="Enrolled">
                        <i class="uil uil-bag menu--icon"></i>
                        <span class="menu--label">{{__('Enrolled')}}</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{ route('stu-messages') }}"
                        class="menu--link {{request()->is('messages*') ? 'active' : ''}}" title="Messages">
                        <i class='uil uil-comments menu--icon'></i>
                        <span class="menu--label">{{__('Messages')}}</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{url('notifications')}}"
                        class="menu--link {{request()->is('notifications') ? 'active' : ''}}" title="Notifications">
                        <i class='uil uil-bell menu--icon'></i>
                        <span class="menu--label">{{__('Notifications')}}</span>
                    </a>
                </li>
                @endif

            </ul>
        </div>
        <div class="left_section">
            <h6 class="left_title">{{__('SUBSCRIPTIONS')}}</h6>
            <ul>

                @if(Auth::guard('student')->check())
                @foreach (Auth::guard('student')->user()->subins(Auth::guard('student')->user()->id) as $item)
                <li class="menu--item">
                    <a href="{{ route('instructorShow', ['id'=>$item->id,'slug'=>  str_replace(' ', '-', strtolower($item->name))]) }}"
                        class="menu--link user_img">
                        <img src="{{ asset($item->image) }}" alt="">
                        {{$item->name}}
                    </a>
                    @if ($item->is_live)

                    <div class="alrt_dot"></div>
                    @endif
                </li>
                @endforeach

                <li class="menu--item">

                    <a href="{{ route('subscription') }}"
                        class="menu--link {{request()->is('subscription') ? 'active' : ''}}" title="See All">
                        <i class='uil uil-eye menu--icon'></i>
                        <span class="menu--label">{{__('See All')}}</span>
                    </a>
                </li>
                @endif
                <li class="menu--item">
                    <a href="{{ route('instructorAll') }}"
                        class="menu--link {{request()->is('instructors') ? 'active' : ''}}" title="Browse Instructors">

                        <i class='uil uil-plus-circle menu--icon'></i>
                        <span class="menu--label">{{__('Browse Instructors')}}</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="left_section pt-2">
            <ul>
                <li class="menu--item">
                    <a href="{{ route('profile.editstu') }}" class="menu--link {{request()->is('profile') ? 'active' : ''}}" title="Setting">
                        <i class='uil uil-cog menu--icon'></i>
                        <span class="menu--label">{{__('Setting')}}</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{ url('help') }}" class="menu--link {{request()->is('help') ? 'active' : ''}}"
                        title="Help">
                        <i class='uil uil-question-circle menu--icon'></i>
                        <span class="menu--label">{{__('Help')}}</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{ url('report') }}" class="menu--link {{request()->is('report') ? 'active' : ''}}"
                        title="Report History">
                        <i class='uil uil-windsock menu--icon'></i>
                        <span class="menu--label">{{__('Report History')}}</span>
                    </a>
                </li>

                <li class="menu--item ">
                    <a href="{{ url('feedback') }}" class="menu--link {{request()->is('feedback') ? 'active' : ''}}"
                        title="Send Feedback">
                        <i class='uil uil-comment-alt-exclamation menu--icon'></i>
                        <span class="menu--label">{{__('Send Feedback')}}</span>
                    </a>
                </li>
            </ul>
        </div>

    </div>
</nav>