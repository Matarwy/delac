<nav class="vertical_nav">
    <div class="left_section menu_left" id="js-menu">
        <div class="left_section">
            <ul>
                <li class="menu--item">
                    <a href="{{ route('ins-home') }}"
                        class="menu--link {{request()->is('instructor/home') ? 'active' : ''}}" title="Dashboard">
                        <i class="uil uil-apps menu--icon"></i>
                        <span class="menu--label">{{__('Dashboard')}}</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{ route('courses.index') }}"
                        class="menu--link {{request()->is('instructor/courses') ? 'active' : ''}}" title="Courses">
                        <i class='uil uil-book-alt menu--icon'></i>
                        <span class="menu--label">{{__('Courses')}}</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{ route('ins-analytics') }}"
                        class="menu--link {{request()->is('instructor/analytics') ? 'active' : ''}}" title="Analyics">
                        <i class='uil uil-analysis menu--icon'></i>
                        <span class="menu--label">{{__('Analyics')}}</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{ route('courses.create') }}"
                        class="menu--link {{request()->is('instructor/courses/create') ? 'active' : ''}}"
                        title="Create Course">
                        <i class='uil uil-plus-circle menu--icon'></i>
                        <span class="menu--label">{{__('Create Course')}}</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{ route('ins-messages') }}"  class="menu--link {{request()->is('instructor/messages*') ? 'active' : ''}}" title="Messages">
                        <i class='uil uil-comments menu--icon'></i>
                        <span class="menu--label">{{__('Messages')}}</span>
                    </a>
                </li>
               
                <li class="menu--item">
                    <a href="{{route('ins-notification')}}"
                        class="menu--link {{request()->is('instructor/notifications') ? 'active' : ''}}"
                        title="Notifications">
                        <i class='uil uil-bell menu--icon'></i>
                        <span class="menu--label">{{__('Notifications')}}</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{ route('live-stream.index')}}"
                        class="menu--link {{request()->is('instructor/live-stream') ? 'active' : ''}} "
                        title="Notifications">
                        <i class='uil uil-film menu--icon'></i>
                        <span class="menu--label">{{__('Live')}}</span>
                    </a>
                </li>

                <li class="menu--item">
                    <a href="{{ route('review.index') }}"
                        class="menu--link {{request()->is('instructor/review') ? 'active' : ''}}" title="Reviews">
                        <i class='uil uil-star menu--icon'></i>
                        <span class="menu--label">{{__('Reviews')}}</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{ url('instructor/earning') }}"
                        class="menu--link {{request()->is('instructor/earning') ? 'active' : ''}}" title="Earning">
                        <i class='uil uil-dollar-sign menu--icon'></i>
                        <span class="menu--label">{{__('Earning')}}</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{ url('instructor/payout') }}"
                        class="menu--link {{request()->is('instructor/payout') ? 'active' : ''}}" title="Payout">
                        <i class='uil uil-wallet menu--icon'></i>
                        <span class="menu--label">{{__('Payout')}}</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{ url('instructor/statements') }}"
                        class="menu--link {{request()->is('instructor/statements') ? 'active' : ''}}"
                        title="Statements">
                        <i class='uil uil-file-alt menu--icon'></i>
                        <span class="menu--label">{{__('Statements')}}</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{ route('verification.index') }}"
                        class="menu--link {{request()->is('instructor/verification') ? 'active' : ''}}"
                        title="Verification">
                        <i class='uil uil-check-circle menu--icon'></i>
                        <span class="menu--label">{{__('Verification')}}</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="left_section pt-2">
            <ul>
                <li class="menu--item">
                    <a href="{{ route('profile.edit') }}"
                        class="menu--link {{request()->is('instructor/profile') ? 'active' : ''}}" title="Setting">
                        <i class='uil uil-cog menu--icon'></i>
                        <span class="menu--label">{{__('Setting')}}</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{ url('instructor/help') }}"
                        class="menu--link {{request()->is('instructor/help') ? 'active' : ''}}" title="Help">
                        <i class='uil uil-question-circle menu--icon'></i>
                        <span class="menu--label">{{__('Help')}}</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{ url('instructor/feedback') }}"
                        class="menu--link {{request()->is('instructor/feedback') ? 'active' : ''}}"
                        title="Send Feedback">
                        <i class='uil uil-comment-alt-exclamation menu--icon'></i>
                        <span class="menu--label">{{__('Send Feedback')}}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>