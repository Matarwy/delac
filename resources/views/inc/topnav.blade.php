<form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>

    </ul>

</form>
<ul class="navbar-nav navbar-right">
    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
            class="nav-link nav-link-lg message-toggle beep"><i class="fa fa-language"></i></a>
        <div class="dropdown-menu dropdown-list dropdown-menu-right">
            <div class="dropdown-header">Languages

            </div>
            <div class="dropdown-list-content dropdown-list-message">
                <a href="{{ route('locale.change',['locale' => 'en']) }}" class="dropdown-item">
                    <div class="dropdown-item-desc">
                        <b>English</b>
                    </div>
                </a>
                @foreach ($weblang as $webl)
                <a href="{{ route('locale.change',['locale' => $webl->short_name]) }}" class="dropdown-item">
                    <div class="dropdown-item-desc">
                        <b>{{$webl->name}}</b>
                    </div>
                </a>
                @endforeach
            </div>

        </div>
    </li>
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{ asset(Auth::guard('web')->user()->image) }}" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, {{Auth::guard('web')->user()->name ?? "No Login"}}</div>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-title">Logged in </div>
            <a href="{{ route('profile.adedit') }}" class="dropdown-item has-icon">
                <i class="far fa-user"></i> {{__('Profile')}}
            </a>

            <a href="{{ route('setting.general') }}" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> {{__('Settings')}}
            </a>
            <div class="dropdown-divider"></div>
            <a href="{{ route('admin.logout') }}" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> {{__('Logout')}}
            </a>
        </div>
    </li>
</ul>