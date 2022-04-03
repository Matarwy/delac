@extends('layouts.admin-master')

@section('title')
{{ __('Instructors ') }}
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
        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-5">
                <div class="card profile-widget">
                    <div class="profile-widget-header">
                        <img alt="image" src="{{ asset($instructor->image) }}"
                            class="rounded-circle profile-widget-picture">
                        <div class="profile-widget-items">
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">{{__('Enroll Course')}}</div>
                                <div class="profile-widget-item-value">
                                    {{$instructor->shortNumber($instructor->enroll_count)}}</div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">{{__('Subsciber')}}</div>
                                <div class="profile-widget-item-value">
                                    {{$instructor->shortNumber($instructor->subscribers_count)}}</div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">{{__('Earning')}}</div>
                                <div class="profile-widget-item-value">
                                    {{ number_format( $instructor->enroll->sum('price') - $instructor->enroll->sum('admin_commission'),2)
                                }}</div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">{{__('Commission')}}</div>
                                <div class="profile-widget-item-value">{{ number_format( $instructor->enroll->sum('admin_commission'),2)
                                                                }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-widget-description">
                        <div class="profile-widget-name">{{$instructor->name}}
                            @if ($instructor->verify_pro == 1 )
                            <i class="fas fa-certificate text-warning"></i>
                            @endif
                            <div class="text-muted d-inline font-weight-normal">
                                <div class="slash"></div> {{$instructor->headline}}
                            </div>
                        </div>
                        {{$instructor->description}}
                    </div>
                    <div class="card-footer text-center">
                        <div class="font-weight-bold mb-2">{{__('Find')}} {{$instructor->name}} {{__('On')}}</div>
                        <a href="{{$instructor->website}}" class="btn btn-social-icon btn-info mr-1">
                            <i class="fas fa-globe-asia"></i>
                        </a>
                        <a href="http://facebook.com/{{$instructor->facebook}}" class="btn btn-social-icon btn-primary mr-1">
                            <i class="fab fa-facebook-f "></i>
                        </a>
                        <a href="http://twitter.com/{{$instructor->twitter}}" class="btn btn-social-icon btn-info mr-1">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="http://www.linkedin.com/{{$instructor->linkedin}}" class="btn btn-social-icon btn-dark mr-1">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="http://www.youtube.com/{{$instructor->youtube}}" class="btn btn-social-icon btn-danger">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                    <div class="card-footer text-center">
                        <div class="font-weight-bold mb-2">{{__('Extra Detail')}}</div>
                        @if ($instructor->popular == 1 )
                        <span class="badge badge-primary">{{__('Popular')}}</span>
                        @endif
                        @if ($instructor->is_live == 1 )
                        <span class="badge badge-danger">{{__('Live Now')}}</span>
                        @endif
                        @if ($instructor->status == 1)
                        <span class="badge badge-light">{{__('Active')}}</span>
                        @endif
                    </div>
                </div>
                <div class="card card-statistic-2">

                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{__('Balance')}}</h4>
                        </div>
                        <div class="card-body">
                            {{number_format($instructor->balance,2)}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-7">
                <div class="card">

                    <div class="card-header">
                        <h4>{{__('Course')}}</h4>
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
                                    @foreach ($instructor->courses ?? [] as $item)
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

                                              <form action="{{ route('admin-course.update', $item->id) }}"
                                                  method="post">
                                                  @csrf
                                                  <input type="hidden" name="status" value="1">
                                                  <button type="button"
                                                      class="btn btn-sm btn-outline-success btn-icon m-1"
                                                      onclick="confirm('{{ __("Are you sure you want to do this?") }}') ? this.parentElement.submit() : ''">
                                                      <span class="ul-btn__icon">{{__('Approved')}}</span>
                                                  </button>
                                              </form>
                                              <form action="{{ route('admin-course.update', $item->id) }}"
                                                  method="post">
                                                  @csrf
                                                  <input type="hidden" name="status" value="4">
                                                  <button type="button"
                                                      class="btn btn-sm btn-outline-success btn-icon m-1"
                                                      onclick="confirm('{{ __("Are you sure you want to do this?") }}') ? this.parentElement.submit() : ''">
                                                      <span class="ul-btn__icon">{{__('Reject')}}</span>
                                                  </button>
                                              </form>
                                              @elseif ($item->status == 3)
                                              <form action="{{ route('admin-course.update', $item->id) }}"
                                                  method="post">
                                                  @csrf
                                                  <input type="hidden" name="status" value="1">
                                                  <button type="button" class="btn btn-sm btn-outline-dark btn-icon m-1"
                                                      onclick="confirm('{{ __("Are you sure you want to do this?") }}') ? this.parentElement.submit() : ''">
                                                      <span class="ul-btn__icon">{{__('Un-Block / Active')}}</span>
                                                  </button>
                                              </form>
                                              @else

                                              <form action="{{ route('admin-course.update', $item->id) }}"
                                                  method="post">
                                                  @csrf
                                                  <input type="hidden" name="status" value="3">
                                                  <button type="button"
                                                      class="btn btn-sm btn-outline-danger btn-icon m-1"
                                                      onclick="confirm('{{ __("Are you sure you want to do this?") }}') ? this.parentElement.submit() : ''">
                                                      <span class="ul-btn__icon">{{__('Block')}}</span>
                                                  </button>
                                              </form>

                                              @endif
                                              @if ($item->status == 1)
                                              <form action="{{ route('admin-course.update', $item->id) }}"
                                                  method="post">
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
                                              <form action="{{ route('admin-course.update', $item->id) }}"
                                                  method="post">
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
                <div class="card">
                    <div class="card-header">
                        <h4>{{__('Discussions')}}</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled list-unstyled-border list-unstyled-noborder">
                            @foreach ($instructor->discussions as $item)
                            <li class="media">
                                <img alt="image" class="mr-3 rounded-circle" width="70"
                                    src="{{ asset($item->student->image ?? "No Data") }}">
                                <div class="media-body">
                                    <div class="media-right">
                                    </div>
                                    <div class="media-title mb-1">{{$item->student->name ?? "No Data"}}</div>
                                    <div class="text-time">{{$item->created_at->diffForHumans()}}</div>
                                    <div class="media-description text-muted">{{$item->comment}}</div>
                                    <div class="media-links">
                                        <a href="#">Like {{count($item->likes)}}</a>
                                        <div class="bullet"></div>
                                        <a href="#" class="text-danger">Dis-Like {{count($item->dislikes)}}</a>
                                    </div>
                                </div>
                            </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection