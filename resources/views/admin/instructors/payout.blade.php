@extends('layouts.admin-master')

@section('title')
{{ __('Instructors Payout') }}
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{ __('Instructors Payout') }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">{{ __('Home') }}</a></div>
            <div class="breadcrumb-item"><a href="#">{{ __('Instructors Payout') }}</a></div>
        </div>
    </div>

    <div class="section-body">
        <x-alert-msg></x-alert-msg>
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header d-felx justify-content-between">
                        <h4>{{ __('Instructors Payout List') }}</h4>

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
                                            {{__('Amount')}}
                                        </th>
                                        <th>
                                            {{__('Remark')}}
                                        </th>
                                        <th>
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
                                    @foreach ($payouts as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $item->instructor->name ?? "No data"}} </td>
                                        <td>{{ number_format($item->amount,2)}}</td>
                                       <td>{{$item->remark ?? '-'}}</td>
                                        <td>
                                            @if ($item->status == 0)
                                            <span class="badge badge-warning m-1">{{__('Pandding')}}</span>
                                            @elseif($item->status == 1)
                                            <span class="badge badge-success m-1">{{__('Paid')}}</span>
                                            @else
                                            <span class="badge badge-danger m-1">{{__('Reject')}}</span>
                                            @endif
                                        </td>
                                        <td>{{$item->updated_at->format('d M Y')}}</td>
                                        <td class="d-flex">

                                            @if ($item->status == 0)

                                            <form action="{{ route('payout.update', $item) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="remark" required
                                                    placeholder="{{ __('Remark please')}}">
                                                <select name="status">
                                                    <option value="1">{{__('Paid')}}</option>
                                                    <option value="2">{{__('Reject')}}</option>
                                                </select>
                                                <button type="button" class="btn btn-sm btn-outline-dark btn-icon m-1"
                                                    onclick="confirm('{{ __("Are you sure you want to delete this?") }}') ? this.parentElement.submit() : ''">
                                                    {{__('Submit')}}
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