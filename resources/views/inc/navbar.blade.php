<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{url('admin/dashboard')}}">{{env("APP_NAME")}}</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{url('admin/dashboard')}}"></a>
    </div>
    <ul class="sidebar-menu">

        <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}"><a class="nav-link"
                href="{{ url('admin/dashboard') }}"><i class="fas fa-tachometer-alt"></i>
                <span>{{__('Dashboard')}}</span></a>
        </li>

        <li class="menu-header">{{__('Starter')}}</li>

        @can('role_access')
        <li class="{{ request()->is('admin/role') ? 'active' : '' }}"><a class="nav-link"
                href="{{ route('role.index') }}"><i class="far fa-address-book"></i> <span>{{__('Role')}}</span></a>
        </li>
        @endcan

        @can('user_access')
        <li class="{{ request()->is('admin/users') ? 'active' : '' }}"><a class="nav-link"
                href="{{ route('users.index') }}"><i class="far fa-user"></i> <span>{{__('Users')}}</span></a>
        </li>
        @endcan

        @can('language_access')
        <li class="{{ request()->is('admin/languages') ? 'active' : '' }}"><a class="nav-link"
                href="{{ route('languages.index') }}"><i class="fas fa-language"></i>
                <span>{{__('Languages')}}</span></a></li>
        @endcan

        @can('category_access')
        <li class="{{ request()->is('admin/categories') ? 'active' : '' }}"><a class="nav-link"
                href="{{ route('categories.index') }}"><i class="fas fa-list-ul"></i>
                <span>{{__('Categories')}}</span></a></li>
        @endcan

        @can('sub_category_access')
        <li class="{{ request()->is('admin/sub-categories') ? 'active' : '' }}"><a class="nav-link"
                href="{{ route('sub-categories.index') }}"><i class="fas fa-boxes"></i>
                <span>{{__('Sub Categories')}}</span></a>
        </li>
        @endcan
        <li class="menu-header">{{__('Students')}}</li>

        @can('student_access')
        <li class="{{ request()->is('admin/students*') ? 'active' : '' }}"><a class="nav-link"
                href="{{ route('students.index') }}"><i class="fas fa-user"></i>
                <span>{{__('Student')}}</span></a>
        </li>
        @endcan
        <li class="menu-header">{{__('Instructor')}}</li>

        @can('instructor_access')
        <li class="{{ request()->is('admin/instructors*') ? 'active' : '' }}"><a class="nav-link"
                href="{{ route('instructors.index') }}"><i class="fas fa-chalkboard-teacher"></i>
                <span>{{__('Instructor')}}</span></a>
        </li>
        @endcan

        @can('verification_access')
        <li class="{{ request()->is('admin/verification*') ? 'active' : '' }}"><a class="nav-link"
                href="{{ route('verification.adindex') }}"><i class="fas fa-certificate"></i>
                <span>{{__('Verification')}}</span></a>
        </li>
        @endcan

        @can('payout_access')
        <li class="{{ request()->is('admin/payout*') ? 'active' : '' }}"><a class="nav-link"
                href="{{ route('payout.index') }}"><i class="fas fa-hand-holding-usd"></i>
                <span>{{__('Payout')}}</span></a>
        </li>
        @endcan
        @can('course_access')
        <li class="nav-item dropdown {{ request()->is('admin/courses/*') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-book"></i>
                <span>{{__('Course')}}</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link  {{ request()->is('admin/courses/pending') ? 'active' : '' }}"
                        href="{{ url('admin/courses/pending') }}">{{__('Waiting for approval')}}</a>
                </li>
                <li><a class="nav-link  {{ request()->is('admin/courses/all') ? 'active' : '' }}"
                        href="{{ url('admin/courses/all') }}">{{__('All')}}</a></li>
                <li><a class="nav-link  {{ request()->is('admin/courses/rejected') ? 'active' : '' }}"
                        href="{{ url('admin/courses/rejected') }}">{{__('Rejected')}}</a></li>
            </ul>
        </li>
        @endcan
        <li class="menu-header">{{__('Extra')}}</li>

        @can('setting_access')
        <li class="nav-item dropdown {{ request()->is('admin/setting/*') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-cog"></i>
                <span>{{__('Settings')}}</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('setting.general') }}">{{__('General')}}</a>
                </li>
                <li><a class="nav-link" href="{{ route('setting.legal') }}">{{__('Legal')}}</a>
                </li>
                <li><a class="nav-link" href="{{ route('setting.social') }}">{{__('Social')}}</a>
                </li>
                <li><a class="nav-link" href="{{ route('setting.payment') }}">{{__('Payment')}}</a>
                </li>
                <li><a class="nav-link" href="{{ route('setting.seo') }}">{{__('SEO')}}</a>
                </li>
                <li><a class="nav-link" href="{{ route('setting.mail') }}">{{__('Mail')}}</a>
                </li>
                <li><a class="nav-link" href="{{ route('setting.pushnoti') }}">{{__('Push Notification')}}</a>
                </li>
                <li><a class="nav-link" href="{{ route('setting.appearance') }}">{{__('Appearance')}}</a>
                </li>
                <li><a class="nav-link" href="{{ route('setting.other') }}">{{__('Other')}}</a>
                </li>

            </ul>
        </li>
        @endcan
        @can('report_access')
        <li class="nav-item dropdown {{ request()->is('admin/report/*') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-file-word"></i>
                <span>{{__('Reports')}}</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('report.earning') }}">{{__('Earning')}}</a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('report.coursesell') }}">{{__('Cource Selling')}}
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('report.subscription') }}">{{__('Subscription')}}
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('report.instructorreg') }}">{{__('Instructor Registration ')}}
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('report.stureg') }}">{{__('Student Registration')}}
                    </a>
                </li>

            </ul>
        </li>
        @endcan

        @can('feedback_access')
        <li class="{{ request()->is('admin/feedback') ? 'active' : '' }}"><a class="nav-link"
                href="{{ route('feedback.index') }}"><i class="fas fa-comment"></i>
                <span>{{__('Feedback')}}</span></a>
        </li>
        @endcan

        @can('notification_access')
        <li class="{{ request()->is('admin/noti-template') ? 'active' : '' }}"><a class="nav-link"
                href="{{ route('noti-template.index') }}"><i class="fas fa-bell"></i>
                <span>{{__('Notification Template')}}</span></a>
        </li>
        @endcan
        @can('lang_access')
        <li class="{{ request()->is('admin/web-language') ? 'active' : '' }}"><a class="nav-link"
                href="{{ route('web-language.index') }}"><i class="fa fa-language"></i>
                <span>{{__('Web Languages')}}</span></a>
        </li>
        @endcan

        @can('faq_access')
        <li class="{{ request()->is('admin/faqs') ? 'active' : '' }}"><a class="nav-link"
                href="{{ route('faqs.index') }}"><i class="fas fa-question"></i>
                <span>{{__('FAQ')}}</span></a>
        </li>
        @endcan
    </ul>

</aside>