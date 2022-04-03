@extends('frontend.layouts.ins-master')

@push('styles')


@endpush
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2 class="st_title"><i class="uil uil-book-alt"></i>{{__('Courses')}}</h2>
    </div>
    <div class="col-md-12">
        <div class="card_dash1">
            <div class="card_dash_left1">
                <i class="uil uil-book-alt"></i>
                <h1>{{__('Jump Into Course Creation')}}</h1>
            </div>
            <div class="card_dash_right1">
                <button class="create_btn_dash" onclick="window.location.href = '{{ route('courses.create') }}';">{{__('Create
                    Your
                    Course')}}</button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="my_courses_tabs">
            <ul class="nav nav-pills my_crse_nav" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-my-courses-tab" data-toggle="pill" href="#pills-my-courses"
                        role="tab" aria-controls="pills-my-courses" aria-selected="true"><i
                            class="uil uil-book-alt"></i>{{__('My Courses')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-my-purchases-tab" data-toggle="pill" href="#pills-my-purchases"
                        role="tab" aria-controls="pills-my-purchases" aria-selected="false"><i
                            class="uil uil-download-alt"></i>{{__('Drafts')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-upcoming-courses-tab" data-toggle="pill"
                        href="#pills-upcoming-courses" role="tab" aria-controls="pills-upcoming-courses"
                        aria-selected="false"><i class="uil uil-upload-alt"></i>{{__('Upcoming Courses')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-discount-tab" data-toggle="pill" href="#pills-discount" role="tab"
                        aria-controls="pills-discount" aria-selected="false"><i
                            class="uil uil-tag-alt"></i>{{__('Discounts')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-promotions-tab" data-toggle="pill" href="#pills-promotions" role="tab"
                        aria-controls="pills-promotions" aria-selected="false"><i
                            class="uil uil-megaphone"></i>{{__('Promotions')}}</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-my-courses" role="tabpanel">
                    <div class="table-responsive mt-30">
                        <table class="table ucp-table">
                            <thead class="thead-s">

                                <tr>
                                    <th class="text-center" scope="col">#</th>
                                    <th>{{__('Title')}}</th>
                                    <th class="text-center" scope="col">{{__('Updated Date')}}</th>
                                    <th class="text-center" scope="col">{{__('Sales')}}</th>
                                    <th class="text-center" scope="col">{{__('Parts')}}</th>
                                    <th class="text-center" scope="col">{{__('Category')}}</th>
                                    <th class="text-center" scope="col">{{__('Status')}}</th>
                                    <th class="text-center" scope="col">{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$item->title}}</td>
                                    <td class="text-center">{{$item->updated_at->format('d M Y | H:I ')}}</td>
                                    <td class="text-center">{{$item->enroll_count}}</td>
                                    <td class="text-center">{{$item->content_count}}</td>
                                    <td class="text-center"><span class="text-primary">{{$item->category->name ?? "No Data"}}</span></td>
                                    <td class="text-center ">
                                        @if($item->status == 1)
                                        <b class="course_active text-success">{{$item->status($item->status)}}</b>
                                        @elseif($item->status == 0)
                                        <b class="course_active text-warning">{{$item->status($item->status)}}</b>
                                        @else
                                        <b class="course_active ">{{$item->status($item->status)}}</b>
                                        @endif

                                    </td>
                                    <td class="text-center d-flex justify-content-center">
                                        <a href="{{ route('courses.edit', $item->id) }}" title="Edit" class="gray-s"><i
                                                class="uil uil-edit-alt"></i></a>
                                        @if ($item->status == 1)

                                        <a href="{{ route('courses.updateStatus',['id'=> $item->id,'status'=> 0]) }}"
                                            title="{{__('Back To Draft')}}" class="gray-s"><i
                                                class="uil uil-corner-down-left"></i></a>
                                        @endif
                                        @if ($item->enroll_count == 0)
                                        <form action="{{ route('courses.destroy', $item) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <a href="#" type="submit"
                                                onclick="confirm('{{ __("Are you sure you want to delete this?") }}') ? this.parentElement.submit() : ''"
                                                title="Delete" class="gray-s"><i class="uil uil-trash-alt"></i></a>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-my-purchases" role="tabpanel">
                    <div class="table-responsive mt-30">
                        <table class="table ucp-table">
                            <thead class="thead-s">
                                <tr>
                                    <th class="text-center" scope="col">#</th>
                                    <th class="cell-ta" scope="col">{{__('Title')}}</th>
                                    <th class="text-center" scope="col">{{__('Thumbnail')}}</th>
                                    <th class="cell-ta" scope="col">{{__('Category')}}</th>
                                    <th class="text-center" scope="col">{{__('Parts')}}</th>
                                    <th class="text-center" scope="col">{{__('Last Update')}}</th>
                                    <th class="text-center" scope="col">{{__('Price')}}</th>
                                    <th class="text-center" scope="col">{{__('Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($draft as $item)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="cell-ta">{{$item->title}}</td>
                                    <td class="text-center"><a href="{{ asset($item->cover_image) }}"
                                            target="_blank">{{__('View')}}</a></td>
                                    <td class="cell-ta"><span
                                            class="text-primary">{{$item->category->name ?? "No Data"}}</span></td>
                                    <td class="text-center">{{$item->content_count}}</td>

                                    <td class="text-center">{{$item->updated_at->format('d M Y | H:I ')}}</td>
                                    <td class="text-center">{{$item->real_price}}</td>
                                    <td class="text-center d-flex justify-content-center">
                                        <a href="{{ route('courses.edit', $item->id) }}" title="Edit" class="gray-s"><i
                                                class="uil uil-edit-alt"></i></a>
                                        <a href="{{ route('courses.updateStatus',['id'=> $item->id,'status'=> 2]) }}"
                                            title="{{__('Give For Review')}}" class="gray-s"><i
                                                class="uil uil-arrow-from-right"></i></a>
                                        @if ($item->enroll_count == 0)
                                        <form action="{{ route('courses.destroy', $item) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <a href="#" type="submit"
                                                onclick="confirm('{{ __("Are you sure you want to delete this?") }}') ? this.parentElement.submit() : ''"
                                                title="Delete" class="gray-s"><i class="uil uil-trash-alt"></i></a>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-upcoming-courses" role="tabpanel">
                    <div class="table-responsive mt-30">
                        <table class="table ucp-table">
                            <thead class="thead-s">
                                <tr>
                                    <th class="text-center" scope="col">{{__('Item No.')}}</th>
                                    <th class="cell-ta">{{__('Title')}}</th>
                                    <th class="text-center" scope="col">{{__('Thumbnail')}}</th>
                                    <th class="text-center">{{__('Category')}}</th>
                                    <th class="text-center">{{__('Price')}}</th>
                                    <th class="text-center">{{__('Last Update')}}</th>
                                    <th class="text-center" scope="col">{{__('Status')}}</th>
                                    <th class="text-center" scope="col">{{__('Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($upcoming as $item)

                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="cell-ta">{{$item->title}}</td>
                                    <td class="text-center"><a href="{{ asset('upload/'. $item->cover_image) }}"
                                            target="_blank">{{__('View')}}</a></td>
                                    <td class="text-center"><span
                                            class="text-primary">{{$item->category->name ?? "No Data"}}</span></td>
                                    <td class="text-center">{{$item->real_price}}</td>
                                    <td class="text-center">{{$item->updated_at->format('d M Y')}}</td>
                                    <td class="text-center"> @if($item->status == 1)
                                        <b class="course_active text-success">{{$item->status($item->status)}}</b>
                                        @elseif($item->status == 0)
                                        <b class="course_active text-warning">{{$item->status($item->status)}}</b>
                                        @else
                                        <b class="course_active ">{{$item->status($item->status)}}</b>
                                        @endif</td>
                                    <td class="text-center d-flex justify-content-center">
                                        <a href="{{ route('courses.edit', $item->id) }}" title="Edit" class="gray-s"><i
                                                class="uil uil-edit-alt"></i></a>
                                        <a href="{{ route('courses.updateStatus',['id'=> $item->id,'status'=> 0]) }}"
                                            title="{{__('Back To Draft')}}" class="gray-s"><i
                                                class="uil uil-corner-down-left"></i></a>

                                        @if ($item->enroll_count == 0)
                                        <form action="{{ route('courses.destroy', $item) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <a href="#" type="submit"
                                                onclick="confirm('{{ __("Are you sure you want to delete this?") }}') ? this.parentElement.submit() : ''"
                                                title="Delete" class="gray-s"><i class="uil uil-trash-alt"></i></a>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-discount" role="tabpanel">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <div class="panel-title adcrse1250">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                        href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        {{__('New Discount')}}
                                    </a>
                                </div>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel"
                                aria-labelledby="headingOne">
                                <div class="panel-body adcrse_body">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="discount_form">
                                                <form action="{{ route('special-discount.store') }}" method="post">
                                                    @csrf

                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="mt-20 lbel25">
                                                                <label>{{__('Course*')}}</label>
                                                            </div>
                                                            <select
                                                                class="ui hj145 dropdown cntry152 prompt srch_explore"
                                                                required name="course_id">
                                                                <option value="">{{__('Select Course')}}</option>
                                                                @foreach ($active as $item)
                                                                <option value="{{$item->id}}"
                                                                    {{$item->is_free == 1 ? 'disabled' : ''}}>
                                                                    {{$item->title .' - '.$item->real_price}}</option>

                                                                @endforeach

                                                            </select>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="ui search focus mt-20 lbel25">
                                                                <label>{{__('Discount Amount')}}</label>
                                                                <div class="ui left icon input swdh19">
                                                                    <input class="prompt srch_explore" type="number"
                                                                        name="percentage" value="" required="" min="1"
                                                                        max="99"
                                                                        placeholder="{{__('Percent (eg. 20 for 20%)')}}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="ui search focus mt-20 lbel25">
                                                                <label>Title*</label>
                                                                <div class="ui left icon input swdh19">
                                                                    <input class="prompt srch_explore" type="text"
                                                                        name="title" value=""
                                                                        placeholder="{{__('Why you give this discount??')}}"
                                                                        required max="50" min="3" pattern="\S+"
                                                                        title="This field is required">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="ui search focus mt-20 lbel25">
                                                                <label>{{__('Start Date')}}</label>
                                                                <div class="ui left icon input swdh19">
                                                                    <input name="start_time"
                                                                        class="prompt srch_explore datepicker-here"
                                                                        type="date" placeholder="dd/mm/yyyy" required
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
                                                                        class="prompt srch_explore datepicker-here"
                                                                        type="date" id="enddate"
                                                                        placeholder="dd/mm/yyyy" required>
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
                    <div class="table-responsive mt-30">
                        <table class="table ucp-table">
                            <thead class="thead-s">
                                <tr>
                                    <th class="text-center" scope="col">#</th>
                                    <th class="cell-ta">{{__('Title')}}</th>
                                    <th class="cell-ta">{{__('Course')}}</th>
                                    <th class="text-center" scope="col">{{__('Date')}}</th>
                                    <th class="text-center" scope="col">{{__('Discount')}}</th>
                                    <th class="text-center" scope="col">{{__('Status')}}</th>
                                    <th class="text-center" scope="col">{{__('Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($discount as $item)


                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="cell-ta">{{$item->title}}</td>
                                    <td class="cell-ta">{{$item->course->title ??  "No data"}}</td>
                                    <td class="text-center">
                                        {{$item->start_time->format('d M Y') . ' to ' . $item->end_time->format('d M Y')}}
                                    </td>
                                    <td class="text-center">{{$item->percentage}}%</td>
                                    <td class="text-center">
                                        <b class="course_active">
                                            {{$item->status($item->end_time,$item->start_time)}}
                                        </b>
                                    </td>
                                    <td class="text-center d-flex justify-content-center">
                                        <a href="{{ route('special-discount.edit', $item->id) }}" title="Edit"
                                            class="gray-s"><i class="uil uil-edit-alt"></i></a>


                                        <form action="{{ route('special-discount.destroy', $item) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <a href="#" type="submit"
                                                onclick="confirm('{{ __("Are you sure you want to delete this?") }}') ? this.parentElement.submit() : ''"
                                                title="Delete" class="gray-s"><i class="uil uil-trash-alt"></i></a>
                                        </form>


                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-promotions" role="tabpanel" aria-labelledby="pills-promotions-tab">
                    <div class="promotion_tab mb-10">
                        <img src="images/dashboard/promotion.svg" alt="">
                        <h4>{{__('We Are come in future with this feature.')}}</h4>
                     
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection