@extends('layouts.admin-master')

@section('title')
{{ __('Earning Report') }}
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{ __('Earning Report') }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">{{ __('Home') }}</a></div>
            <div class="breadcrumb-item"><a href="#">{{ __('Report') }}</a></div>
            <div class="breadcrumb-item"><a href="#">{{ __('Earning') }}</a></div>
        </div>
    </div>

    <div class="section-body">

        <x-alert-msg></x-alert-msg>
        <div class="row">

            <div class="col-12 col-md-12 col-lg-12 ">
                <form action="{{ route('report.earning') }}" method="POST" autocomplete="off"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4>{{__('Filter')}}</h4>

                        </div>
                        <div class="card-body ">
                            <form method="post">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label>{{ __('From Date') }}</label>
                                            <input type="date" name="from" class="form-control" required>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label>{{ __('To Date') }}</label>
                                            <input type="date" name="to" class="form-control" required>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label>{{ __('Instructor') }}</label>

                                            <select name="ins_id[] " multiple class="form-control select2-dd">
                                                @foreach ($inst as $ins)
                                                <option value="{{$ins->id}}">{{$ins->name}}</option>
                                                @endforeach
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
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Sell</h4>
                        </div>
                        <div class="card-body">
                            {{$data->sum('total')}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Instructor Earning</h4>
                        </div>
                        <div class="card-body">
                            {{$data->sum('earning')}}

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Commission</h4>
                        </div>
                        <div class="card-body">
                            {{$data->sum('ac')}}

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-felx justify-content-between">
                        <h4>{{ __('Earning List') }}</h4>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped  no-footer">
                                <thead>
                                    <tr>
                                        <th>
                                            {{__('#')}}
                                        </th>

                                        <th>
                                            {{__('Instructor Name')}}
                                        </th>
                                        <th>
                                            {{__('Date')}}
                                        </th>
                                        <th>
                                            {{__('Instructor Earning')}}
                                        </th>
                                        <th>
                                            {{__('Sell')}}
                                        </th>
                                        <th>
                                            {{__('Commission')}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data ?? [] as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>

                                        <td>{{ $item->instructor->name ?? ""}}</td>
                                        <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                        <td>{{ $item->earning }}</td>
                                        <td>{{ $item->total }}</td>
                                        <td>{{ $item->ac }}</td>


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