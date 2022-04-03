@extends('layouts.admin-master')

@section('title')
{{ __('Instructor Profile Verification') }}
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{ __('Instructor Profile Verification') }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">{{ __('Home') }}</a></div>
            <div class="breadcrumb-item"><a href="#">{{ __('Instructor Profile Verification') }}</a></div>
        </div>
    </div>

    <div class="section-body">
        <x-alert-msg></x-alert-msg>
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header d-felx justify-content-between">
                        <h4>{{ __('Profile Verification List') }}</h4>

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
                                            {{__('File')}}
                                        </th>
                                        <th>
                                            {{__('Status')}}
                                        </th>

                                        <th>
                                            {{__('Date')}}
                                        </th>
                                        <th>
                                            {{__('Action')}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vreq as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td> <a href=""> {{ $item->name}} </a></td>
                                        <td> <a href="{{ asset($item->document) }}" target="_blank">
                                                {{__('View Document')}} </a></td>

                                        <td>

                                            @if ($item->status == 1)
                                            <span class="badge   badge-success m-1">{{__('Approved')}}</span>
                                            @elseif ($item->status == 0)
                                            <span class="badge   badge-dark m-1">{{__('Requested')}}</span>
                                            @else
                                            <span class="badge   badge-danger m-1">{{__('Rejected')}}</span>
                                            @endif

                                        </td>
                                        <td>{{$item->created_at}}</td>
                                        <td class="d-flex">


                                            @if ($item->status != 1)

                                            <form action="{{ route('verification.update', $item) }}" method="post">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" name="status" value="1">
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-success btn-icon m-1"
                                                    onclick="confirm('{{ __("Are you sure you want to do this?") }}') ? this.parentElement.submit() : ''">
                                                    <span class="ul-btn__icon"><i class="far fa-thumbs-up"></i></span>
                                                </button>
                                            </form>@endif
                                            @if ($item->status == 0)
                                            <form action="{{ route('verification.update', $item) }}" method="post">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" name="status" value="2">
                                                <button type="button" class="btn btn-sm btn-outline-danger btn-icon m-1"
                                                    onclick="confirm('{{ __("Are you sure you want to do this?") }}') ? this.parentElement.submit() : ''">
                                                    <span class="ul-btn__icon">
                                                        <i class="far fa-thumbs-down"></i>
                                                    </span>
                                                </button>
                                            </form>
                                            @endif
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