@extends('layouts.admin-master')



@section('title')

{{ __('Subscription Report') }}

@endsection



@section('content')

<section class="section">

    <div class="section-header">

        <h1>{{ __('Subscription Report') }}</h1>

        <div class="section-header-breadcrumb">

            <div class="breadcrumb-item active"><a href="#">{{ __('Home') }}</a></div>

            <div class="breadcrumb-item"><a href="#">{{ __('Report') }}</a></div>

            <div class="breadcrumb-item"><a href="#">{{ __('Subscription') }}</a></div>

        </div>

    </div>



    <div class="section-body">



        <x-alert-msg></x-alert-msg>

        <div class="row">



            <div class="col-12 col-md-12 col-lg-12 ">

                <form action="{{ route('report.subscription') }}" method="POST" autocomplete="off"

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

                                            <label>{{ __('Subscription') }}</label>

                                          

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

            <div class="col-12">

                <div class="card">

                    <div class="card-header d-felx justify-content-between">

                        <h4>{{ __('Subscription List') }}</h4>



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

                                            {{__('Student Name')}}

                                        </th>

                                        <th>

                                            {{__('Instructor Name')}}

                                        </th>

                                        <th>

                                            {{__('Date')}}

                                        </th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach ($data ?? [] as $item)

                                    <tr>

                                        <td>{{$loop->iteration}}</td>

                                        <td>

                                            {{$item->student->name ?? ""}}

                                        </td>

                                        <td>{{ $item->instructor->name ?? ""}}</td>

                                        <td>{{ $item->created_at->format('Y-m-d') }}</td>







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