<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=9">
<title>{{env("APP_NAME")}}</title>

    
    <link rel="icon" type="image/png" href="{{ asset('frontend/images/fav.png') }}">

    
    @include('frontend.inc.styles')

</head>

<body>
    
    <header class="invoice_header clearfix">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-8">
                    <div class="invoice_header_main">
                        <div class="invoice_header_item">
                            <div class="invoice_logo">
                                <a href="{{url('/')}}"><img src="{{ asset('frontend/images/ct_logo.svg') }}" alt=""></a>
                            </div>
                            <p>{{__('Invoice')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    
    <div class="wrapper _bg4586 _new89 p-0">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-8">
                    <div class="invoice_body">
                        <div class="invoice_date_info">
                            <ul>
                                <li>
                                    <div class="vdt-list"><span>{{__('Date :')}}</span>{{$order->created_at->format('d M,Y')}}
                                    </div>
                                </li>

                                <li>
                                    <div class="vdt-list"><span>O{{__('rder ID :')}}</span>{{$order->uid}}</div>
                                </li>
                                <li>
                                    <div class="vdt-list"><span>{{__('Payment Token ')}}:</span>{{$order->payment_token}}</div>
                                </li>
                            </ul>
                        </div>
                        <div class="invoice_dts">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 class="invoice_title">{{__('Invoice')}}</h2>
                                </div>
                                <div class="col-md-6">
                                    <div class="vhls140">
                                        <h4>To</h4>
                                        <ul>
                                            <li>
                                                <div class="vdt-list">{{$order->student->name ?? ""}}</div>
                                            </li>
                                            <li>
                                                <div class="vdt-list">{{$order->student->email ?? ""}}</div>
                                            </li>

                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="invoice_table">
                            <div class="table-responsive-md">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{__('Item')}}</th>
                                            <th scope="col">{{__('Price')}}</th>

                                            <th scope="col">{{__('Total Amount')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">
                                                <div class="user_dt_trans">
                                                    <p>{{$order->course->title ?? ""}}</p>
                                                </div>
                                            </th>
                                            <td>
                                                <div class="user_dt_trans">
                                                    <p>{{$admin_setting[7]['value']}}{{number_format($order->price,2)}}</p>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="user_dt_trans">
                                                    <p>{{$admin_setting[7]['value']}}{{number_format($order->price,2)}}</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="1"></td>
                                            <td colspan="3">
                                                <div class="user_dt_trans jsk1145">
                                                    <div class="totalinv2">{{__('Invoice Total')}} : {{$admin_setting[6]['value']}}
                                                        {{$admin_setting[7]['value']}}{{number_format($order->price,2)}}</div>
                                                    <p>{{__('Paid via')}} {{$order->payment_method}}</p>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="invoice_footer">
                            <div class="leftfooter">
                                <p>{{__('Thanks for buying.')}}</p>
                            </div>
                            <div class="righttfooter">
                                <a class="print_btn" href="javascript:window.print();">{{__('Print')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    @include('frontend.inc.scripts')

</body>

</html>