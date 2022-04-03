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
                            {{__('Edit Discount')}}
                        </a>
                    </div>
                </div>
                <div class="panel-collapse collapse show">
                    <div class="panel-body adcrse_body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="discount_form">
                                    <form action="{{ route('special-discount.update',[$specialDiscount->id]) }}" method="post">
                                        @csrf

                                        @method("PUT")
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="mt-20 lbel25">
                                                    <label>{{__('Course*')}}</label>
                                                </div>
                                                <select class="ui hj145 dropdown cntry152 prompt srch_explore" required
                                                    name="course_id">
                                                    <option value="">{{__('Select Course')}}</option>
                                                    @foreach ($active as $item)
                                                    <option value="{{$item->id}}"
                                                        {{$item->is_free == 1 ? 'disabled' : ''}}
                                                        {{$item->id == $specialDiscount->course_id ? 'selected' : ''}}>
                                                        {{$item->title .' - '.$item->real_price}}</option>

                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="ui search focus mt-20 lbel25">
                                                    <label>{{__('Discount Amount')}}</label>
                                                    <div class="ui left icon input swdh19">
                                                        <input class="prompt srch_explore" type="number"
                                                            name="percentage" value="{{$specialDiscount->percentage}}" required="" min="1" max="99"
                                                            placeholder="{{__('Percent (eg. 20 for 20%)')}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="ui search focus mt-20 lbel25">
                                                    <label>{{__('Title*')}}</label>
                                                    <div class="ui left icon input swdh19">
                                                        <input class="prompt srch_explore" type="text" name="title"
                                                            value="{{$specialDiscount->title}}"
                                                            placeholder="{{__('Why you give this discount??')}}"
                                                            required max="50" min="3">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="ui search focus mt-20 lbel25">
                                                    <label>{{__('Start Date')}}</label>
                                                    <div class="ui left icon input swdh19">
                                                        <input name="start_time"
                                                            class="prompt srch_explore datepicker-here" type="date"
                                                            value="{{$specialDiscount->start_time->format('Y-m-d')}}"
                                                            placeholder="dd/mm/yyyy" required
                                                            min="{{now()->format('Y-m-d')}}" onchange="$('#enddate').attr({
                                                                            'min' : this.value,
                                                                            });">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="ui search focus mt-20 lbel25">
                                                    <label>{{__('End Date')}}</label>
                                                    <div class="ui left icon input swdh19">
                                                        <input name="end_time"
                                                        value="{{$specialDiscount->end_time->format('Y-m-d')}}"
                                                            class="prompt srch_explore datepicker-here" type="date"
                                                            id="enddate" placeholder="dd/mm/yyyy" required>
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