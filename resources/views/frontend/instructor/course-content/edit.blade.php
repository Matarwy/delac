@extends('frontend.layouts.ins-master')

@push('styles')

@endpush
@section('content')
<style>
    .badge_num {
        padding: 5px 11px;
    }

    .badge_num2 {
        padding: 5px 11px;

    }
</style>
<div class="row">
    <div class="col-lg-12">
        <h2 class="st_title"><i class="uil uil-book-alt"></i>{{__('Edit Courses Content')}}</h2>
    </div>
    <div class="col-md-12">
        <div class="card_dash1">
            <div class="card_dash_left1">
                <i class="uil uil-book-alt"></i>
                <h1>{{__('Go Back to List')}}</h1>
            </div>
            <div class="card_dash_right1">
                <button class="create_btn_dash"
                    onclick="window.location.href = '{{url()->previous() }}';">{{__('Back')}}</button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <div class="panel-title adcrse1250">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                            aria-expanded="false" aria-controls="collapseOne">
                            {{__('Edit Courses Content')}}
                        </a>
                    </div>
                </div>
                <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body adcrse_body">

                        <div class="row">

                            <div class="col-lg-12 col-md-12 col-12">
                                <form action="{{ route('course-content.update',[$courseContent->id]) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method("PUT")
                                    <div class="discount_form">
                                        <div class="general_info10">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-12 text-center">
                                                    <div class="ui search focus mt-30 lbel25">
                                                        <label>{{__('Title*')}}</label>
                                                        <div class="ui left icon input swdh19">
                                                            <input class="prompt srch_explore" type="text"
                                                                placeholder="{{__('Insert your course title.')}}"
                                                                name="title" data-purpose="edit-course-title"
                                                                maxlength="60"
                                                                value="{{old('title',$courseContent->title)}}" required
                                                                pattern="\S+" title="This field is required">
                                                            <div class="badge_num" data-purpose="form-control-counter">
                                                                60</div>
                                                        </div>

                                                    </div>
                                                    @error('title')
                                                    <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <button class="discount_btn" type="submit">{{__('Save Changes')}}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-12 col-md-12 col-12">
                               
                                @include('frontend.instructor.lecture.create')

                            </div>
                        </div>

                    </div>
                </div>
                <div class="panel-heading mt-2" role="tab" id="headingTwo">
                    <div class="panel-title adcrse1250">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
                            aria-expanded="false" aria-controls="collapseTwo">
                            {{__('Edit Lectures')}}
                        </a>
                    </div>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body adcrse_body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="discount_form">

                                    <div class="table-responsive mt-4">
                                        <table class="table ucp-table" id="content-table">
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
                                                        {{__('Last Update ')}}</th>
                                                    <th class="text-center" scope="col">
                                                        {{__('File')}}</th>
                                                    <th class="text-center" scope="col">
                                                        {{__('Controls')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($courseContent->lectures as $item)
                                                <tr>
                                                    <td class="text-center">{{$loop->iteration}}</td>
                                                    <td class="cell-ta">{{$item->title}}</td>
                                                    <td class="text-center">{{$item->volume}}MB</td>
                                                    <td class="text-center">{{$item->duration}} {{__('Minutes')}}</td>

                                                    <td class="text-center">{{$item->updated_at->format('d M Y')}}</td>
                                                    <td class="text-center"><a href="{{ asset($item->file) }}"
                                                            target="_blank">{{__('View')}}</a></td>
                                                    <td class="text-center">
                                                        @if (!$loop->first)
                                                        <a href="{{ route('lectures.move', ['lecture'=>$item->id,'moved'=>"up"]) }}"
                                                            title="Edit" class="gray-s"><i
                                                                class="fas fa-angle-up"></i></a>
                                                        @endif
                                                        @if (!$loop->last)
                                                        <a href="{{ route('lectures.move', ['lecture'=>$item->id,'moved'=>"down"]) }}"
                                                            title="Edit" class="gray-s"><i
                                                                class="fas fa-angle-down"></i></a>
                                                        @endif
                                                        <a href="{{ route('lectures.edit', $item->id) }}" title="Edit" class="gray-s"><i
                                                                class="uil uil-edit-alt"></i></a>
                                                        <form action="{{ route('lectures.destroy', $item) }}"
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