@extends('layouts.admin-master')

@section('title')
{{ __('Courses') }}
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{ __('Courses') }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">{{ __('Home') }}</a></div>
            <div class="breadcrumb-item"><a href="#">{{ __('Courses') }}</a></div>
        </div>
    </div>

    <div class="section-body">
        <x-alert-msg></x-alert-msg>
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header d-felx justify-content-between">
                        <h4>{{ __('Courses List') }}</h4>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped  no-footer">
                                <thead>
                                    <tr>
                                        <th>
                                            {{__(' #')}}
                                        </th>
                                        <th>
                                            {{__('Title')}}
                                        </th>
                                        <th>
                                            {{__('Category')}}
                                        </th>
                                        <th>
                                            {{__('Price')}}
                                        </th>
                                        <th class="text-center">
                                            {{__('Status')}}
                                        </th>
                                        <th>
                                            {{__('Last Update')}}
                                        </th>
                                        <th>
                                            {{__('Action')}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $item->title}}
                                            @if ($item->is_bestseller)

                                            <span class="badge badge-secondary m-1">{{__('Bestseller')}}</span>
                                            @endif

                                            @if ($item->is_featured)

                                           <span class="badge badge-dark m-1">{{__('Featured')}}</span>
                                            @endif

                                        </td>
                                        <td>{{ $item->category->name ?? "No Data"}}</td>
                                        <td>{{ $item->real_price}}</td>

                                        <td class="text-center text-primary">

                                            {{$item->status($item->status)}}

                                        </td>
                                        <td>{{$item->updated_at->format('d M Y')}}</td>

                                        <td class="d-flex">

                                            @can('course_show')
                                            <a class="btn btn-sm btn-outline-info btn-icon m-1"
                                                href="{{ route('admin-course.show', $item->id) }}">
                                                {{__('View')}}
                                            </a>
                                            @if ($item->status == 2)

                                            <form action="{{ route('admin-course.update', $item->id) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="status" value="1">
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-success btn-icon m-1"
                                                    onclick="confirm('{{ __("Are you sure you want to do this?") }}') ? this.parentElement.submit() : ''">
                                                    <span class="ul-btn__icon">{{__('Approved')}}</span>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin-course.update', $item->id) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="status" value="4">
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-success btn-icon m-1"
                                                    onclick="confirm('{{ __("Are you sure you want to do this?") }}') ? this.parentElement.submit() : ''">
                                                    <span class="ul-btn__icon">{{__('Reject')}}</span>
                                                </button>
                                            </form>
                                            @elseif ($item->status == 3)
                                            <form action="{{ route('admin-course.update', $item->id) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="status" value="1">
                                                <button type="button" class="btn btn-sm btn-outline-dark btn-icon m-1"
                                                    onclick="confirm('{{ __("Are you sure you want to do this?") }}') ? this.parentElement.submit() : ''">
                                                    <span class="ul-btn__icon">{{__('Un-Block / Active')}}</span>
                                                </button>
                                            </form>
                                            @else

                                            <form action="{{ route('admin-course.update', $item->id) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="status" value="3">
                                                <button type="button" class="btn btn-sm btn-outline-danger btn-icon m-1"
                                                    onclick="confirm('{{ __("Are you sure you want to do this?") }}') ? this.parentElement.submit() : ''">
                                                    <span class="ul-btn__icon">{{__('Block')}}</span>
                                                </button>
                                            </form>

                                            @endif
                                            @if ($item->status == 1)
                                            <form action="{{ route('admin-course.update', $item->id) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="is_bestseller"
                                                    value="{{$item->is_bestseller == 0 ? '1' : '0'}}">
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-secondary btn-icon m-1"
                                                    onclick="confirm('{{ __("Are you sure you want to do this?") }}') ? this.parentElement.submit() : ''">
                                                    <span class="ul-btn__icon"> @if ($item->is_bestseller == 0)
                                                        {{__('Bestseller')}}
                                                        @else
                                                        {{__('Remove Bestseller')}}
                                                        @endif</span>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin-course.update', $item->id) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="is_featured"
                                                    value="{{$item->is_featured == 0 ? '1' : '0'}}">
                                                <button type="button" class="btn btn-sm btn-outline-dark btn-icon m-1"
                                                    onclick="confirm('{{ __("Are you sure you want to do this?") }}') ? this.parentElement.submit() : ''">

                                                    <span class="ul-btn__icon"> @if ($item->is_featured == 0)
                                                        {{__('Featured')}}
                                                        @else
                                                        {{__('Remove Featured')}}
                                                        @endif</span>
                                                </button>
                                            </form>
                                            @endif
                                            @endcan
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
</section>
@endsection
