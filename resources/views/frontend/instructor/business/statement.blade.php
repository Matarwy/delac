@extends('frontend.layouts.ins-master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2 class="st_title"><i class="uil uil-file-alt"></i> {{__('Statements')}}</h2>
    </div>
</div>
<div class="row">
    <div class="col-lg-8 col-md-7">
        <div class="top_countries mt-30">
            <div class="top_countries_title">
                <h2>{{__('Earnings')}}</h2>
            </div>
            <div class="statement_content">
                <p class="tt-body">{{__('Your sales earnings over the period')}} </p>
                <table class="statement-summary__table">
                    <thead>
                        <tr>
                            <th>
                                <p class="t-heading">{{__('My funds')}}</p>
                            </th>
                            <th>
                                <p class="t-heading">{{__('Earnings')}}</p>
                            </th>
                            <th>
                                <p class="t-heading">{{env("APP_NAME")}} {{__('Fees')}}</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="statement-summary__funds">
                                <p class="js-earnings__instructor-funds-wrapper">
                                    <span class=""></span>
                                    <span
                                        class="js-earnngs__instructor-funds t-currency">{{$admin_setting[7]['value']}}{{ number_format($state['total'],2) }}</span>
                                </p>
                            </td>
                            <td class="statement-summary__earnings">
                                <p class="js-earnings__earnings-wrapper">
                                    <span class="tt__earning">+</span>
                                    <span
                                        class="js-earnings__earnings t-currency">{{$admin_setting[7]['value']}}{{ number_format($state['earning'],2) }}</span>
                                </p>
                            </td>
                            <td class="statement-summary__fees">
                                <p class="js-earnings__fees-wrapper">
                                    <span class="tt__earning">-</span>
                                    <span
                                        class="js-earnings__fees t-currency">{{$admin_setting[7]['value']}}{{ number_format($state['commission'],2) }}</span>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-5">
        <div class="top_countries mt-30">
            <div class="top_countries_title">
                <h2>View Invoices</h2>
            </div>
            <div class="statement_invoice_content">
                <form action="{{ url('instructor/statements') }}" method="post" id="myForm">
                    <div class="date_selector mt-0">
                        @csrf
                        <div class="ui selection dropdown skills-search vchrt-dropdown invoice-dropdown">
                            <input name="date" type="hidden" value="default"
                                onchange='document.getElementById("myForm").submit();'>
                            <i class="dropdown icon d-icon"></i>
                            <div class="text">{{__('Monthly Invoices')}}</div>
                            <div class="menu">
                                @foreach ($months as $item)
                                <div class="item" data-value="{{$item}}">{{$item}}</div>
                                @endforeach
                            </div>
                        </div>
                       
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12">
        <ul class="more_options_tt">
            <li><button class="more_items_14 active">{{$today->format('M,Y')}}</button></li>
          
        </ul>
    </div>
    <div class="col-lg-12 col-md-12">
        <div class="table-responsive mt-30">
            <table class="table ucp-table earning__table">
                <thead class="thead-s">
                    <tr>
                        <th scope="col">{{__('Date')}}</th>
                        <th scope="col">{{__('Order ID')}}</th>
                        <th scope="col">{{__('Type')}}</th>
                        <th scope="col">{{__('Title')}}</th>
                        <th scope="col">{{__('Amount')}}</th>
                        <th scope="col">{{__('Fees')}}</th>
                        <th scope="col">{{__('Invoice')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $item)

                    <tr>
                        <td>{{$item->created_at->format('d M Y')}}</td>
                        <td>{{$item->uid}}</td>
                        <td>Sale</td>
                        <td>{{$item->course->title ?? 'No Data'}}</td>
                        <td>{{$admin_setting[7]['value']}}{{$item->price}}</td>
                        <td> -{{$admin_setting[7]['value']}}{{$item->admin_commission}}</td>
                        <td><a href="{{ route('order.invoice-ins', ['id'=>$item->id]) }} " target="_blank">{{__('View')}}</a></td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection