@extends('frontend.layouts.ins-master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2 class="st_title"><i class="uil uil-dollar-sign"></i> {{__('Earning')}}</h2>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="earning_steps">
            <p>{{__('Sales earnings:')}}</p>
            <h2>{{$admin_setting[7]['value']}}{{$state['total']}}</h2>
        </div>
    </div>
    <div class="col-md-4">
        <div class="earning_steps">
            <p>{{__('Your balance:')}}</p>
            <h2>{{$admin_setting[7]['value']}}{{$state['earning']}}</h2>
        </div>
    </div>
    <div class="col-md-4">
        <div class="earning_steps">
            <p>{{__('Admin commission:')}}</p>
            <h2>{{$admin_setting[7]['value']}}{{$state['commission']}}</h2>
        </div>
    </div>
    <div class="col-lg-4 col-md-12">
        <div class="top_countries mt-50">
            <div class="top_countries_title">
                <h2>{{__('Your Top Course')}}</h2>
            </div>
            <ul class="country_list">
                @foreach ($orders as $item)

                <li>
                    <div class="country_item">
                        <div class="country_item_left">
                            <span>{{$item->course->title ?? "No Data"}} ({{$item->total}})</span>
                        </div>
                        <div class="country_item_right">
                            <span>{{$admin_setting[7]['value']}}{{$item->totamount - $item->commission}}</span>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="col-lg-8 col-md-12">
        <div class="date_selector">
            <form action="{{ url('instructor/earning') }}" method="post" id="myForm">
                @csrf
                <div class="ui selection dropdown skills-search vchrt-dropdown">
                    <input name="date" type="hidden" value="default"
                        onchange='document.getElementById("myForm").submit();'>
                    <i class="dropdown icon d-icon"></i>
                    <div class="text">{{__('Item Sales')}}</div>
                    <div class="menu">
                        @foreach ($months as $item)
                        <div class="item" data-value="{{$item}}">{{$item}}</div>
                        @endforeach
                    </div>
                </div>
            </form>
            <div class="date_list152">
                <a href="#">{{__('All Time')}}</a> /
                <a href="#">{{$today->format('Y')}}</a> /
                <a href="#">{{$today->format('F')}}</a>
            </div>
        </div>
        <div class="table-responsive mt-30">
            <table class="table ucp-table earning__table">
                <thead class="thead-s">
                    <tr>
                        <th scope="col">{{__('Date')}}</th>
                        <th scope="col">{{__('Item Sales Count')}}</th>
                        <th scope="col">{{__('Earning')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datewise as $item)

                    <tr>
                        <td>{{$item->created_at->format('d, l')}}</td>
                        <td>{{$item->total}}</td>
                        <td>{{$admin_setting[7]['value']}}{{$item->earning}}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td>Total</td>
                        <td>{{$state['d_total']}}</td>
                        <td>{{$admin_setting[7]['value']}}{{$state['d_earning']}}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection