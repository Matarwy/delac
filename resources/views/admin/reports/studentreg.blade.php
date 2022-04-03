@extends('layouts.admin-master')

@section('title')
{{ __('Student Report') }}
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{ __('Student Report') }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">{{ __('Home') }}</a></div>
            <div class="breadcrumb-item"><a href="#">{{ __('Report') }}</a></div>
            <div class="breadcrumb-item"><a href="#">{{ __('Student') }}</a></div>
        </div>
    </div>

    <div class="section-body">


        <x-alert-msg></x-alert-msg>
        <div class="row">

            <div class="col-12 col-md-12 col-lg-12 ">
                <form action="{{ route('report.stureg') }}" method="POST" autocomplete="off"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4>{{__('Filter')}}</h4>

                        </div>
                        <div class="card-body ">
                            <form method="post">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('From Date') }}</label>
                                            <input type="date" name="from" class="form-control" required>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('To Date') }}</label>
                                            <input type="date" name="to" class="form-control" required>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary" type="submit">{{__('Submit')}}</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-felx justify-content-between">
                        <h4>{{ __('Students List') }}</h4>

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
                                            {{__('Name')}}
                                        </th>
                                        <th>
                                            {{__('Email')}}
                                        </th>
                                        <th>
                                            {{__('Register Date')}}
                                        </th>
                                        <th>
                                            {{__('Status')}}
                                        </th>

                                        <th>
                                            {{__('Action')}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students ?? [] as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            <a href="{{ route('students.show', ['student'=>$item]) }}">{{ $item->name}}
                                            </a>
                                        </td>
                                        <td>{{ $item->email}}</td>
                                        <td>{{ $item->created_at->format('Y-m-d') }}</td>

                                        <td>

                                            @if ($item->status == 1)
                                            <span class="badge   badge-success m-1">{{__('Active')}}</span>

                                            @else
                                            <span class="badge   badge-danger m-1">{{__('Block')}}</span>
                                            @endif


                                        </td>

                                        <td class="d-flex">

                                            @can('student_edit')
                                            <form action="{{ route('students.update', $item->id) }}" method="post">
                                                @csrf
                                                @method("PUT")
                                                <input type="hidden" name="status"
                                                    value="{{$item->status == 0 ? '1' : '0'}}">
                                                <button type="button" class="btn btn-sm btn-outline-danger btn-icon m-1"
                                                    onclick="confirm('{{ __("Are you sure you want to do this?") }}') ? this.parentElement.submit() : ''">
                                                    <span class="ul-btn__icon"> @if ($item->status == 1)
                                                        {{__('Block')}}
                                                        @else
                                                        {{__('Un-Block')}}
                                                        @endif</span>
                                                </button>
                                            </form>
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