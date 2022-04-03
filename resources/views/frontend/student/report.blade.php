@extends('frontend.layouts.ins-master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2 class="st_title"><i class='uil uil-windsock'></i> {{__('Report history')}}</h2>
        <div class="row">
            <div class="col-lg-12">
                <div class="report_history">
                    <h4>{{__('Thanks for reporting')}}</h4>
                    <p>{{__('Any member of the Website community can flag content to us that they believe violates our
                        Community Guidelines. When something is flagged, it’s not automatically taken down. Flagged
                        content is reviewed in line with the following guidelines:')}}</p>
                    <ul>
                        <li>
                            <p>{{__('Content that violates our')}} <a href="#">{{__('Community Guidelines')}}</a> i{{__('s removed from Website.')}}
                            </p>
                        </li>
                        <li>
                            <p>{{__('Content that may not be appropriate for all younger audiences may be age-restricted.')}}</p>
                        </li>
                    </ul>
                    <a href="#" class="lnk586">{{__('Learn more about reporting content on Website.')}}</a>
                    <ul>
                        @forelse ($reports as $item)
                        <li>
                            <p>{{__('You Report')}} <a href="#">{{$item->course->title ?? "No Data"}}</a> {{__('on')}}
                                {{$item->created_at->format('Y-m-d')}}
                            </p>
                        </li>

                        @empty
                    </ul>
                    <span>{{__('You haven`t submitted any reports.')}}</span>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection