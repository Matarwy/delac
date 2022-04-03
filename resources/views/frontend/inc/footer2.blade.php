<div class="tc_footer_main">
    <div class="tc_footer_left">
        <ul>

            <li><a href="{{ url('legal/'.'copyright-policy') }}">{{__('Copyright Policy')}}</a></li>
            <li><a href="{{ url('legal/'.'terms-conditions') }}">{{__('Terms')}}</a></li>
            <li><a href="{{ url('legal/'.'privacy-policy') }}">{{__('Privacy Policy')}}</a></li>
        </ul>
    </div>
    <div class="tc_footer_right">
        <p>© {{date('Y')}} <strong>{{env("APP_NAME")}}</strong>. {{__(' All Rights Reserved.')}}</p>
    </div>
</div>