@extends('frontend.layouts.ins-master')

@push('styles')
<style>
    .step-steps li {
        pointer-events: none;
    }
</style>

<link href="{{ asset('frontend/css/jquery-steps.css')}}" rel="stylesheet">
@endpush

@section('content')
@php
$currantstep = $currantstep ?? 0;
@endphp
<div class="row">
    <div class="col-lg-12">
        <h2 class="st_title"><i class="uil uil-analysis"></i> {{__('Create New Course')}}</h2>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="course_tabs_1">
            <div id="add-course-tab" class="step-app">
                <ul class="step-steps">
                    <li class="{{$currantstep >= 1 ? 'done' : ''}} {{$currantstep == 0 ? 'active' : ''}}">
                        <a href="#tab_step1">
                            <span class="number"></span>
                            <span class="step-name">{{__('General Information')}}</span>
                        </a>
                    </li>
                    <li class="{{$currantstep >= 2 ? 'done' : ''}} {{$currantstep == 1 ? 'active' : ''}}">
                        <a href="#tab_step2">
                            <span class="number"></span>
                            <span class="step-name">{{__('View')}}</span>
                        </a>
                    </li>
                    <li class="{{$currantstep >= 3 ? 'done' : ''}} {{$currantstep == 2 ? 'active' : ''}}">
                        <a href="#tab_step3">
                            <span class="number"></span>
                            <span class="step-name">{{__('Course Content')}}</span>
                        </a>
                    </li>
                    <li {{$currantstep >= 4 ? 'done' : ''}} {{$currantstep == 3 ? 'active' : ''}}>
                        <a href="#tab_step4">
                            <span class="number"></span>
                            <span class="step-name">{{__('Extra Information')}}</span>
                        </a>
                    </li>
                </ul>
                <div class="step-content">
                    <div class="step-tab-panel step-tab-info {{$currantstep == 0 ? 'active' : ''}}" id="tab_step1">
                        <div class="tab-from-content">
                            <div class="title-icon">
                                <h3 class="title"><i class="uil uil-info-circle"></i>{{__('General Information')}}
                                </h3>
                            </div>
                            <div class="course__form">
                                <form action="{{ route('courses.store') }}" method="post" id="formId1">
                                    @csrf
                                    <div class="general_info10">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 text-center">
                                                <div class="ui search focus mt-30 lbel25">
                                                    <label>{{__('Course Title*')}}</label>
                                                    <div class="ui left icon input swdh19">
                                                        <input class="prompt srch_explore" type="text"
                                                            placeholder="{{__('Insert your course title.')}}"
                                                            name="title" data-purpose="edit-course-title" maxlength="60"
                                                            value="{{old('title')}}" required>
                                                        <div class="badge_num" data-purpose="form-control-counter">60
                                                        </div>
                                                    </div>

                                                </div>
                                                @error('title')
                                                <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6 col-md-6 text-center">
                                                <div class="ui search focus mt-30 lbel25">
                                                    <label>{{__('Course Subtitle*')}}</label>
                                                    <div class="ui left icon input swdh19">
                                                        <input class="prompt srch_explore" type="text"
                                                            placeholder="{{__('Insert your course Subtitle.')}}"
                                                            name="subtitle" data-purpose="edit-course-title"
                                                            maxlength="120" id="sub[title]" value="{{old('subtitle')}}">
                                                        <div class="badge_num2" data-purpose="form-control-counter">120
                                                        </div>
                                                    </div>
                                                    @error('subtitle')
                                                    <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 ">
                                                <div class="course_des_textarea mt-30 lbel25">
                                                    <label>{{__('Course Description*')}}</label>
                                                    <div class="course_des_bg">

                                                        <div class="textarea_dt">
                                                            <div class="ui form swdh339">
                                                                <div class="field">
                                                                    <textarea rows="5" name="description"
                                                                        class="id_course_description"
                                                                        placeholder="{{__('Insert your course description')}}">{{old('description')}}</textarea>
                                                                </div>
                                                            </div>
                                                            @error('description')
                                                            <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 text-center">
                                                <div class="mt-30 lbel25">
                                                    <label>{{__('Language*')}}</label>
                                                </div>
                                                <select class="ui hj145 dropdown cntry152 prompt srch_explore"
                                                    name="language_id">
                                                    <option value="">{{__('Select Language')}}</option>
                                                    @foreach ($languages ?? [] as $item)

                                                    <option value="{{$item['id']}}"
                                                        {{ $item['id'] == old('language_id') ? 'selected' : ''}}>
                                                        {{$item['name']}}</option>
                                                    @endforeach
                                                </select>
                                                @error('language_id')
                                                <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                                                @enderror
                                            </div>
                                            <div class="col-lg-4 col-md-6 text-center">
                                                <div class="mt-30 lbel25">
                                                    <label>{{__('Course Category*')}}</label>
                                                </div>
                                                <select class="ui hj145 dropdown cntry152 prompt srch_explore"
                                                    name="category_id" id="category">
                                                    <option value="">{{__('Select Category')}}</option>
                                                    @foreach ($category ?? [] as $item)

                                                    <option value="{{$item['id']}}">{{$item['name']}}</option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                                                @enderror
                                            </div>
                                            <div class="col-lg-4 col-md-6 text-center">
                                                <div class="mt-30 lbel25">
                                                    <label>{{__('Course Subcategory*')}}</label>
                                                </div>
                                                <select class="ui hj145 dropdown cntry152 prompt srch_explore"
                                                    name="subcategory_id" id="subCategory">
                                                    <option value="">{{__('Select Subcategory')}}</option>

                                                </select>
                                                @error('subcategory_id')
                                                <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="price_course">
                                        <div class="row">
                                            <div class="col-lg-12 ">
                                                <div class="price_title">
                                                    <h4><i class="uil uil-dollar-sign-alt"></i>{{__('Pricing')}}</h4>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-sm-12 text-center">
                                                <div class="mt-30 lbel25">
                                                    <label>{{__('Is Free*')}}</label>
                                                </div>
                                                <select class="ui hj145 dropdown cntry152 prompt srch_explore is_free"
                                                    name="is_free">
                                                    <option value="0" {{old('is_free') == 0 ? 'selected' : ''}}>
                                                        {{__('No')}}
                                                    </option>
                                                    <option value="1" {{old('is_free') == 1 ? 'selected' : ''}}>
                                                        {{__('Yes')}}
                                                    </option>
                                                </select>
                                                @error('is_free')
                                                <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                                                @enderror

                                            </div>
                                            <div
                                                class="col-lg-5 col-md-6 col-sm-6 text-center is_free_div
                                                {{old('is_free') == 1 ? 'd-none' : ''}}">
                                                <div class="ui search focus mt-30 lbel25">
                                                    <label>{{__('Price*')}}</label>
                                                    <div class="ui left icon input swdh19">
                                                        <input class="prompt srch_explore" type="number"
                                                            placeholder="{{__('Insert your course Price.')}}"
                                                            name="price" data-purpose="edit-course-title"
                                                            value="{{old('price')}}" required>

                                                    </div>
                                                    @error('price')
                                                    <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div
                                                class="col-lg-5 col-md-6 col-sm-6 text-center is_free_div
                                                {{old('is_free') == 1 ? 'd-none' : ''}}">
                                                <div class="ui search focus mt-30 lbel25">
                                                    <label>{{__('Discount Price')}}</label>
                                                    <div class="ui left icon input swdh19">
                                                        <input class="prompt srch_explore" type="number"
                                                            placeholder="{{__('Discount Price if have .')}}"
                                                            name="discount_price" data-purpose="edit-course-title"
                                                            value="{{old('discount_price',0)}}">

                                                    </div>
                                                    @error('discount_price')
                                                    <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="step-tab-panel step-tab-gallery {{$currantstep == 1 ? 'active' : ''}}" id="tab_step2">
                        <div class="tab-from-content">
                            <div class="title-icon">
                                <h3 class="title"><i class="uil uil-image-upload"></i>{{__('View')}}</h3>
                            </div>
                            <div class="course__form">
                                <div class="view_info10">
                                    <form action="{{ route('courses.mediaUpdate') }}" method="post" id="formId2"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="courseid" value="{{Session::get('courseid')}}"
                                            id="courseid">

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="view_all_dt">
                                                    <div class="view_img_left">
                                                        <div class="view__img">
                                                            <img src="{{ asset('frontend/images/courses/add_img.jpg')}}"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                    <div class="view_img_right">
                                                        <h4>{{__('Cover Image')}}</h4>
                                                        <p>{{__('Upload your course image here. It must meet our
                                                            course image quality standards to be accepted.
                                                            Important guidelines: 750x422 pixels; .jpg,
                                                            .jpeg,. gif, or .png. no text on the image max file size
                                                            1mb.')}}</p>
                                                        <div class="upload__input">
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input"
                                                                        id="inputGroupFile04" name="cover_image"
                                                                        accept="image/*">
                                                                    <label class="custom-file-label"
                                                                        for="inputGroupFile04">{{__('No Choose
                                                                        file')}}</label>
                                                                </div>
                                                                @error('cover_image')
                                                                <x-invalid-feedback> {{ $message }}
                                                                </x-invalid-feedback>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="view_all_dt">
                                                    <div class="view_img_left">
                                                        <div class="view__img">
                                                            <img src="{{ asset('frontend/images/courses/add_video.jpg')}}"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                    <div class="view_img_right">
                                                        <h4>{{__('Promotional Video')}}</h4>
                                                        <p>{{__('Students who watch a well-made promo video are 5X
                                                            more likely to enroll in your course. We`ve seen
                                                            that statistic go up to 10X for exceptionally
                                                            awesome videos. Learn how to make yours awesome!. max file
                                                            size 5mb')}}
                                                        </p>
                                                        <div class="upload__input">
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input"
                                                                        id="inputGroupFile05" accept="video/*"
                                                                        name="promotional_video">
                                                                    <label class="custom-file-label"
                                                                        for="inputGroupFile05">{{__('Choose
                                                                        file')}}</label>
                                                                </div>
                                                                @error('promotional_video')
                                                                <x-invalid-feedback> {{ $message }}
                                                                </x-invalid-feedback>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="step-tab-panel step-tab-location {{$currantstep == 2 ? 'active' : ''}}" id="tab_step3">
                        <div class="tab-from-content">
                            <div class="title-icon">
                                <h3 class="title"><i class="uil uil-film"></i>{{__('Course Content')}}</h3>
                            </div>
                            <div class="course__form">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="extra_info">
                                            <h4 class="part__title">{{__('New Course Content')}}</h4>
                                        </div>

                                        <input type="hidden" name="ContentFormURL"
                                            value={{route('course-content.store') }} id="ContentFormURL">

                                        <div class="view_info10">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="ui search focus mt-30 lbel25">
                                                        <label>{{__('Course Content Title*')}}</label>
                                                        <div class="ui left icon input swdh19">
                                                            <input class="prompt srch_explore" type="text"
                                                                placeholder="{{__('Insert your course content title.')}}"
                                                                name="title" data-purpose="edit-course-title"
                                                                maxlength="60" id="ContentTitle" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                           <form action="" method="post" enctype="multipart/form-data"
                                                    id="lecturefrom" class="row">
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="lecture_title">
                                                            <h4>{{__('Add Lecture')}}</h4>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4 col-md-12">
                                                        <div class="ui search focus mt-30 lbel25">
                                                            <label>{{__('Lecture Title*')}}</label>
                                                            <div class="ui left icon input swdh19">
                                                                <input class="prompt srch_explore" type="text"
                                                                    placeholder="{{__('Insert your lecture title.')}}"
                                                                    name="title" data-purpose="edit-course-title"
                                                                    maxlength="60" id="title" value="" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="part_input mt-30 lbel25">
                                                            <label>{{__('File*')}}</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input"
                                                                        id="lectureFileInput" name="file" required
                                                                        onchange="onLectureFileChange()" accept="image/* , application/pdf,video/*">
                                                                    <label class="custom-file-label"
                                                                        for="inputGroupFile06">{{__('No Choose
                                                                        file - (Pdf, Video)')}}</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="ui search focus mt-30 lbel25">
                                                            <label>{{__('Sort')}}</label>
                                                            <div class="ui left icon input swdh19">
                                                                <input class="prompt srch_explore" type="number" min="0"
                                                                    max="100" placeholder="0" name="position" required>
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
                                                                                placeholder="{{__('Insert your course description')}}">{{old('description')}}</textarea>
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
                                                                    required="" placeholder="0" name="volume">
                                                                <div class="badge_mb">MB</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5 col-md-6">
                                                        <div class="ui search focus mt-30 lbel25">
                                                            <label>{{__('Duration*')}}</label>
                                                            <div class="ui left icon input swdh19 swdh55">
                                                                <input class="prompt srch_explore" type="number" min="0"
                                                                    required="" placeholder="0" name="duration">
                                                                <div class="badge_min">{{__('Minutes')}}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-12">
                                                        <button class="part_btn_save prt-sv" type="submit">{{__('Save
                                                            Lecture')}}</button>
                                                    </div>
                                                </form>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="table-responsive mt-50 mb-0">
                                                        <table class="table ucp-table">
                                                            <thead class="thead-s">
                                                                <tr>
                                                                    <th class="text-center" scope="col">
                                                                        {{__('Lecture')}}</th>
                                                                    <th class="cell-ta">{{__('Title')}}</th>
                                                                    <th class="text-center" scope="col">
                                                                        {{__('Volume')}}</th>
                                                                    <th class="text-center" scope="col">
                                                                        {{__('Duration')}}</th>
                                                                    <th class="text-center" scope="col">
                                                                        {{__('Sort')}}</th>
                                                                    <th class="text-center" scope="col">
                                                                        {{__('File')}}</th>
                                                                    <th class="text-center" scope="col">
                                                                        {{__('Controls')}}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tbodylecture">


                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="save_content">
                                                        <button class="save_content_btn" onclick="FinalCourseContent()">{{__('Save Course
                                                            Content')}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive mt-30">
                                <table class="table ucp-table" id="content-table">
                                    <thead class="thead-s">
                                        <tr>
                                            <th class="text-center" scope="col">{{__('Content')}}</th>
                                            <th class="cell-ta">{{__('Title')}}</th>
                                            <th class="text-center" scope="col">{{__('lectures')}}</th>
                                            <th class="text-center" scope="col">{{__('Volume')}}</th>
                                            <th class="text-center" scope="col">{{__('Duration')}}</th>
                                            <th class="text-center" scope="col">{{__('Upload Date')}}</th>
                                            <th class="text-center" scope="col">{{__('Controls')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($course_content as $item)
                                        <tr>
                                            <td class="text-center">{{$loop->iteration}}</td>
                                            <td class="cell-ta">{{$item->title}}</td>
                                            <td class="text-center">{{$item->lectures_count}}</td>
                                            <td class="text-center">{{$item->lectures()->sum('volume')}}</td>
                                            <td class="text-center">{{$item->lectures()->sum('duration')}}</td>
                                            <td class="text-center">{{$item->updated_at->format('d M Y')}}</td>
                                            <td class="text-center">
                                                <form action="{{ route('course-content.destroy', $item) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="#" type="submit"
                                                        onclick="confirm('{{ __("Are you sure you want to delete this?") }}') ? this.parentElement.submit() : ''"
                                                        title="Delete" class="gray-s"><i
                                                            class="uil uil-trash-alt"></i></a>
                                                </form>

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('courses.sessionUpdate') }}" method="post" id="formId3"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="currantstep" value="3">
                    </form>
                    <div class="step-tab-panel step-tab-amenities {{$currantstep == 3 ? 'active' : ''}}" id="tab_step4">
                        <div class="tab-from-content">
                            <div class="title-icon">
                                <h3 class="title"><i class="uil uil-file-copy-alt"></i>{{__('Extra Information')}}
                                </h3>
                            </div>
                            <div class="course__form">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="extra_info">
                                            <h4 class="part__title">{{__('Extra Information')}}</h4>
                                        </div>
                                        <div class="view_info10">


                                            <form
                                                action="{{ route('courses.update', [Session::get('courseid') ?? 0]) }}"
                                                method="post" id="formId4" enctype="multipart/form-data" class="row">
                                                @csrf
                                                @method("PUT")
                                                <div class="col-lg-6 col-md-6 col-sm-12 text-center">
                                                    <div class="mt-30 lbel25">
                                                        <label>{{__('What you want save as*')}}</label>
                                                    </div>
                                                    <select class="ui hj145 dropdown cntry152 prompt srch_explore"
                                                        name="status">
                                                        <option value="2">
                                                            {{__('Submit For Review')}}
                                                        </option>
                                                        <option value="0">
                                                            {{__(' Draft')}}
                                                        </option>

                                                    </select>
                                                    @error('status')
                                                    <x-invalid-feedback> {{ $message }}
                                                    </x-invalid-feedback>
                                                    @enderror

                                                </div>
                                            </form>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="step-footer step-tab-pager">
                    <button data-direction="prev" class="btn btn-default steps_btn">{{__('PREVIOUS')}}</button>
                    <button data-direction="next" class="btn btn-default steps_btn">{{__('Next')}}</button>
                    <button data-direction="finish" onclick="submitForm('#formId4')" class="btn btn-default steps_btn"
                        type="button">{{__('Submit')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('frontend/js/jquery-steps.min.js')}}"></script>
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
        $('#category').change(function () {
            var id = $(this).val();

            $('#subCategory').find('option').not(':first').remove();

            $.ajax({
                url: "{{ url('category/') }}" + '/' + id,
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    var len = 0;
                    if (response.data != null) {
                        len = response.data.length;
                    }

                    if (len > 0) {
                        for (var i = 0; i < len; i++) {
                            var id = response.data[i].id;
                            var name = response.data[i].name;
                            var option = "<option value='" +
                                id + "'>" + name + "</option>";

                            $("#subCategory").append(option);
                        }
                    }
                }
            })
        });
    });
    var currantstep = '{{ $currantstep ?? 0 }}'

    $('#add-course-tab').steps({
        startAt: currantstep,
        forceMoveForward: true,
        showBackButton: false,
        enableAllSteps: false,
        onChange: function (event, currentIndex, newIndex) {

            if (event <= 2 ) {


                $("#formId" + currentIndex).submit();
            }



            return true;

        },
        onFinish: function () {
        }
    });
</script>
@endpush
