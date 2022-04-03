@extends('layouts.admin-master')

@section('title')
{{ __('FAQ') }}
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{ __('FAQ') }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">{{ __('Home') }}</a></div>
            <div class="breadcrumb-item"><a href="#">{{ __('FAQ') }}</a></div>
        </div>
    </div>

    <div class="section-body">
        <x-alert-msg></x-alert-msg>
        <div class="row">

            <div class="col-12 col-md-8 col-lg-8 ">
                <div class="card">
                    <div class="card-header d-felx justify-content-between">
                        <h4>{{ __('FAQ List') }}</h4>

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
                                                {{__('Question')}}
                                            </th>
                                            <th>
                                                {{__('Answer')}}
                                            </th>
                                            <th>
                                                {{__('For Who')}}
                                            </th>

                                            <th>
                                                {{__('Action')}}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($faqs as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ $item->question}}</td>
                                            <td>{{ $item->ans}}</td>

                                            <td>

                                                @if ($item->faq_for == 1)
                                                <span class="badge   badge-success m-1">{{__('Teacher')}}</span>

                                                @else
                                                <span class="badge   badge-danger m-1">{{__('Student')}}</span>
                                                @endif


                                            </td>

                                            <td class="d-flex">

                                                @can('faq_edit')
                                                <a class="btn btn-sm btn-outline-info btn-icon m-1"
                                                    href="{{ route('faqs.edit', $item->id) }}">
                                                    <span class="ul-btn__icon"><i class="fas fa-pencil-alt"></i></span>
                                                </a>
                                                @endcan
                                                @can('faq_delete')

                                                <form action="{{ route('faqs.destroy', $item) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-danger btn-icon m-1"
                                                        onclick="confirm('{{ __("Are you sure you want to delete this?") }}') ? this.parentElement.submit() : ''">
                                                        <span class="ul-btn__icon"><i
                                                                class="far fa-trash-alt"></i></span>
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

                @can('faq_create')
                @includeUnless(isset($faq), 'admin.faqs.create')
                @else
                <div class="hero bg-danger text-white">
                    <div class="hero-inner">
                        <h2>{{__('You dont have permissions')}}</h2>
                        <p class="lead">{{__('You dont have permissions')}}</p>
                    </div>
                </div>
                @endcan
                @can('faq_edit')
                @includeWhen(isset($faq), 'admin.faqs.edit')
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