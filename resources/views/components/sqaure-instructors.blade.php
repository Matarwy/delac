<div class="item">
    <div class="fcrse_1 mb-20">
        <div class="tutor_img">
            <a
                href="{{ route('instructorShow', ['id'=>$ins->id,'slug'=>  str_replace(' ', '-', strtolower($ins->name))]) }}"><img
                    src="{{ asset($ins->image) }}" alt=""></a>
        </div>
        <div class="tutor_content_dt">
            <div class="tutor150">
                <a href="{{ route('instructorShow', ['id'=>$ins->id,'slug'=>  str_replace(' ', '-', strtolower($ins->name))]) }}"
                    class="tutor_name">{{$ins->name}}</a>
                @if ($ins->verify_pro)
                <div class="mef78" title="Verify">
                    <i class="uil uil-check-circle"></i>
                </div>
                @endif
            </div>
            <div class="tutor_cate">{{$ins->headline}}</div>
            <ul class="tutor_social_links">
                <li><a href="http://facebook.com/{{$ins->facebook}}" class="fb"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="http://twitter.com/{{$ins->twitter}}" class="tw"><i class="fab fa-twitter"></i></a></li>
                <li><a href="http://www.linkedin.com/{{$ins->linkedin}}" class="ln"><i class="fab fa-linkedin-in"></i></a></li>
                <li><a href="http://www.youtube.com/{{$ins->youtube}}" class="yu"><i class="fab fa-youtube"></i></a></li>
            </ul>
            <div class="tut1250">
                <span class="vdt15">{{$ins->shortNumber($ins->enroll_count)}} {{__('Students')}}</span>
                <span class="vdt15">{{$ins->courses_count}} {{__('Courses')}}</span>
            </div>
        </div>
    </div>
</div>