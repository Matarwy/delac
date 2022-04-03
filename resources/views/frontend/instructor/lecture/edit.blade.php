@extends('frontend.layouts.ins-master')

@push('styles')


@endpush
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2 class="st_title"><i class="uil uil-book-alt"></i>{{__('Edit Discount')}}</h2>
    </div>
    <div class="col-md-12">
        <div class="card_dash1">
            <div class="card_dash_left1">
                <i class="uil uil-book-alt"></i>
                <h1>{{__('Go Back to List')}}</h1>
            </div>
            <div class="card_dash_right1">
                <button class="create_btn_dash"
                    onclick="window.location.href = '{{ route('courses.index') }}';">{{__('Back')}}</button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading" id="headingOne">
                    <div class="panel-title adcrse1250">
                        <a class="collapsed">
                            {{__('Edit Lecture')}}
                        </a>
                    </div>
                </div>
                <div class="panel-collapse collapse show">
                    <div class="panel-body adcrse_body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="discount_form">
                                    <form action="{{ route('lectures.update',[$lecture->id]) }}" method="post">
                                        @csrf

                                        @method("PUT")
                                        <div class="row">

                                            <div class="col-lg-6 col-md-12">
                                                <div class="ui search focus mt-30 lbel25">
                                                    <label>{{__('Lecture Title*')}}</label>
                                                    <div class="ui left icon input swdh19">
                                                        <input class="prompt srch_explore" type="text"
                                                            placeholder="{{__('Insert your lecture title.')}}"
                                                            name="title" data-purpose="edit-course-title" maxlength="60"
                                                            id="title" value="{{$lecture->title}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="part_input mt-30 lbel25">
                                                    <label>{{__('File*')}} <a target="_blank"
                                                            href="{{ asset($lecture->file) }}">{{__('View')}}</a></label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                id="lectureFileInput" name="file" >
                                                            <label class="custom-file-label"
                                                                for="inputGroupFile06">{{__('No Choose file - (Pdf, Video)')}}</label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-12">
                                                <div class="course_des_textarea mt-30 lbel25">
                                                    <label>{{__('Description*')}}</label>
                                                    <div class="course_des_bg">

                                                        <div class="textarea_dt">
                                                            <div class="ui form swdh339">
                                                                <div class="field">
                                                                    <textarea rows="5" name="description"
                                                                        class="id_course_description"
                                                                        placeholder="{{__('Insert your course description')}}">{{old('description',$lecture->description)}}</textarea>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-md-6">
                                                <div class="ui search focus mt-30 lbel25">
                                                    <label>{{__('Volume*')}}</label>
                                                    <div class="ui left icon input swdh19 swdh95">
                                                        <input class="prompt srch_explore" type="number" min="0"
                                                            required="" placeholder="0" name="volume"
                                                            value="{{$lecture->volume}}">
                                                        <div class="badge_num">MB</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-md-6">
                                                <div class="ui search focus mt-30 lbel25">
                                                    <label>{{__('Duration*')}}</label>
                                                    <div class="ui left icon input swdh19 swdh55">
                                                        <input class="prompt srch_explore" type="number" min="0"
                                                            required="" placeholder="0" name="duration"
                                                            value={{$lecture->duration}}>
                                                        <div class="badge_num">{{__('Min')}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <button class="discount_btn" type="submit">{{__('Save
                                                    Changes')}}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="{{ asset('frontend/js/course.js')}}"></script>
<link href="{{ asset('admin/assets/js/summernote.min.css') }}" rel="stylesheet">
<script src="{{ asset('admin/assets/js/summernote.min.js') }}"></script>

<script>
    "use strict";
   $(function () {
       
     $('.id_course_description').summernote({
         height: 120,
         toolbar: [
             ['style', ['style']],
             ['font', ['bold', 'underline', 'clear']],
             ['color', ['color']],
             ['para', ['ul', 'ol', 'paragraph']],
             ['table', ['table']],

             ['view', ['fullscreen', 'codeview', 'help']]
         ]
     });
    
 });
   


            
</script>
@endpush