@extends('layouts.admin-master')

@section('title')
{{ __('Languages') }}
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{ __('Languages') }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">{{ __('Home') }}</a></div>
            <div class="breadcrumb-item"><a href="#">{{ __('Languages') }}</a></div>
        </div>
    </div>

    <div class="section-body">


        <x-alert-msg></x-alert-msg>
        <div class="row">

            <div class="col-12 col-md-12 col-lg-12 ">
                <div class="card">
                    <div class="card-header d-felx justify-content-between">
                        <h4>{{ __('Languages List') }}</h4>
                        <a href="{{ route('web-language.create') }}">{{__('New')}}
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped  no-footer">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('Name')}}</th>
                                        <th>{{__('Short Name')}}</th>

                                        <th>{{__('Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lang as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $item->name}} </td>
                                        <td>{{ $item->short_name}} </td>

                                        <td class="d-flex">
                                            @can('lang_edit')
                                            <a class="btn btn-outline-info btn-icon m-1"
                                                href="{{ route('web-language.edit', $item->id) }}">
                                                <span class="ul-btn__icon"><i class="fas fa-pencil-alt"></i></span>
                                            </a>
                                            <a class="btn btn-outline-success btn-icon m-1"
                                                href="{{ route('download.langFile', $item->short_name) }}">
                                                <span class="ul-btn__icon"><i class="fas fa-download"></i></span>
                                            </a>
                                            @endcan
                                            @can('lang_delete')

                                            <form action="{{ route('web-language.destroy', $item) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-outline-danger btn-icon m-1"
                                                    onclick="confirm('{{ __("Are you sure you want to delete this?") }}') ? this.parentElement.submit() : ''">
                                                    <span class="ul-btn__icon"><i class="far fa-trash-alt"></i></span>
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