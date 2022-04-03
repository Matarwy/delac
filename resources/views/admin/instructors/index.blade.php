@extends('layouts.admin-master')

@section('title')
{{ __('Instructors') }}
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{ __('Instructors') }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">{{ __('Home') }}</a></div>
            <div class="breadcrumb-item"><a href="#">{{ __('Instructors') }}</a></div>
        </div>
    </div>

    <div class="section-body">
        <x-alert-msg></x-alert-msg>
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header d-felx justify-content-between">
                        <h4>{{ __('Instructors List') }}</h4>

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
                                            {{__('Status')}}
                                        </th>

                                        <th>
                                            {{__('Action')}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($instructors as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $item->name}}
                                            @if ($item->popular)
                                            
                                            <span class="badge badge-dark m-1">{{__('Popular')}}</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->email}}</td>

                                        <td>

                                            @if ($item->status == 1)
                                            <span class="badge   badge-success m-1">{{__('Active')}}</span>

                                            @else
                                            <span class="badge   badge-danger m-1">{{__('De-Active')}}</span>
                                            @endif


                                        </td>

                                        <td class="d-flex">
                                            <form action="{{ route('instructors.update', $item->id) }}" method="post">
                                                @csrf
                                                @method("PUT")
                                                <input type="hidden" name="popular"
                                                    value="{{$item->popular == 0 ? '1' : '0'}}">
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-dark btn-icon m-1"
                                                    onclick="confirm('{{ __("Are you sure you want to do this?") }}') ? this.parentElement.submit() : ''">
                                                    <span class="ul-btn__icon"> @if ($item->popular == 0)
                                                        {{__('Popular')}}
                                                        @else
                                                        {{__('Remove Popular')}}
                                                        @endif</span>
                                                </button>
                                            </form>
                                             <form action="{{ route('instructors.update', $item->id) }}" method="post">

                                                 @csrf

                                                 @method("PUT")

                                                 <input type="hidden" name="status"
                                                     value="{{$item->status == 0 ? '1' : '0'}}">

                                                 <button type="button"
                                                     class="btn btn-sm btn-outline-danger btn-icon m-1"
                                                     onclick="confirm('{{ __("Are you sure you want to do this?") }}') ? this.parentElement.submit() : ''">

                                                     <span class="ul-btn__icon"> @if ($item->status == 1)

                                                         {{__('Block')}}

                                                         @else

                                                         {{__('Un-Block')}}

                                                         @endif</span>

                                                 </button>

                                             </form>

                                            @can('instructor_show')
                                            <a class="btn btn-sm btn-outline-info btn-icon m-1"
                                                href="{{ route('instructors.show', $item->id) }}">
                                                <span class="ul-btn__icon"><i class="far fa-eye"></i></span>
                                            </a>
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