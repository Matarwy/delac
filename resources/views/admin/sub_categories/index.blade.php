@extends('layouts.admin-master')

@section('title')
{{ __('Sub Categories') }}
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{ __('Sub Categories') }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">{{ __('Home') }}</a></div>
            <div class="breadcrumb-item"><a href="#">{{ __('Sub Categories') }}</a></div>
        </div>
    </div>

    <div class="section-body">
        <x-alert-msg></x-alert-msg>
        <div class="row">

            <div class="col-12 col-md-8 col-lg-8 ">
                <div class="card">
                    <div class="card-header d-felx justify-content-between">
                        <h4>{{ __('Sub Categories List') }}</h4>

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
                                            {{__('Category')}}
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
                                    @foreach ($sub_categories as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $item->name}}</td>
                                        <td>{{ $item->category->name ?? " "}}</td>

                                        <td>

                                            @if ($item->status == 1)
                                            <span class="badge   badge-success m-1">{{__('Active')}}</span>

                                            @else
                                            <span class="badge   badge-danger m-1">{{__('De-Active')}}</span>
                                            @endif


                                        </td>

                                        <td class="d-flex">

                                            @can('sub_category_edit')
                                            <a class="btn btn-sm btn-outline-info btn-icon m-1"
                                                href="{{ route('sub-categories.edit', $item->id) }}">
                                                <span class="ul-btn__icon"><i class="fas fa-pencil-alt"></i></span>
                                            </a>
                                            @endcan
                                            @can('sub_category_delete')

                                            <form action="{{ route('sub-categories.destroy', $item) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-sm btn-outline-danger btn-icon m-1"
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
            <div class="col-12 col-md-4 col-lg-4">

                @can('sub_category_create')
                @includeUnless(isset($subCategory), 'admin.sub_categories.create')
                @else
                <div class="hero bg-danger text-white">
                    <div class="hero-inner">
                        <h2>{{__('You dont have permissions')}}</h2>
                        <p class="lead">{{__('You dont have permissions')}}</p>
                    </div>
                </div>
                @endcan
                @can('sub_category_edit')
                @includeWhen(isset($subCategory), 'admin.sub_categories.edit')
                @else
                <div class="hero bg-danger text-white">
                    <div class="hero-inner">
                        <h2>{{__('You dont have permissions')}}</h2>
                        <p class="lead">{{__('You dont have permissions')}}</p>
                    </div>
                </div>
                @endcan

            </div>
        </div>
    </div>
</section>
@endsection