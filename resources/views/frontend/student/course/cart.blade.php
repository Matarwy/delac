@extends('frontend.layouts.ins-master')
@section('content')
<div class="row">
    <div class="col-lg-12">

        <div class="title126">
            <h2>{{__('Shopping Cart')}}</h2>
        </div>
    </div>
</div>
<div class="mb4d25">
    <div class="container">
        <div class="row">
            @if (count($courses) <= 0) <div class="col-12">
                <x-nodata></x-nodata>
        </div>
        @else
        <div class="col-lg-8">
            @foreach ($courses as $course)

            <div class="fcrse_1 mb-30">
                <a href="{{ route('courseShow', ['slug'=> str_replace(' ', '-', strtolower($course->title)),'id' => $course->id]) }}"
                    class="hf_img">
                    <img class="cart_img" src="{{ asset($course->cover_image) }}" alt="">
                </a>
                <div class="hs_content">
                    <div class="eps_dots eps_dots10 more_dropdown">
                        <a href="{{ route('removefromcart',['id'=>$course->id]) }}"><i class='uil uil-times'></i></a>
                    </div>
                    <a href="{{ route('courseShow', ['slug'=> str_replace(' ', '-', strtolower($course->title)),'id' => $course->id]) }}"
                        class="crse14s title900 pt-2">{{$course->title}}</a>
                    <a href="#" class="crse-cate">{{$course->category->name ?? "No Data"}} |
                        {{$course->subCategory->name ?? "No Data"}}</a>
                    <div class="auth1lnkprce">
                        <p class="cr1fot">{{__('By')}} <a href="#">{{$course->instructor->name ?? "No Data"}}</a>
                        </p>

                        @if ($course->is_free == 0)
                        @if ($course->discount_price < $course->price)
                            <div class="prce142">{{$admin_setting[7]['value']}}{{$course->real_price}}</div>
                            <div class="prce142 pr-2 text-danger">
                                <s>{{$admin_setting[7]['value']}}{{$course->price}}</s>
                            </div>
                            @else
                                <div class="prce142">{{$admin_setting[7]['value']}}{{$course->real_price}}</div>
                            @endif
                            @else
                                <div class="prce142">{{$admin_setting[7]['value']}}{{$course->real_price}}</div>
                            @endif

                    </div>
                    @if ($course->spedis)

                    <div class="auth1lnkprce">

                        <p class="cr1fot">{{$course->spedis->title}} {{__('till')}} <a
                                href="#">{{$course->spedis->end_time->format('d M,Y')}}</a>
                        </p>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-lg-4">
            <div class="membership_chk_bg rght1528">
                <div class="checkout_title">
                    <h4>{{__('Total')}}</h4>
                    <img src="images/line.svg" alt="">
                </div>
                <div class="order_dt_section">
                    <div class="order_title">
                        <h4>{{__('Orignal Price')}}</h4>
                        <div class="order_price">{{$admin_setting[7]['value']}}{{$total}}</div>
                    </div>
                    <div class="order_title">
                        <h6>{{__('Discount Price')}}</h6>
                        <div class="order_price">{{$admin_setting[7]['value']}}{{$discount}}</div>
                    </div>
                    <div class="order_title">
                        <h2>{{__('Total')}}</h2>
                        <div class="order_price5">{{$admin_setting[7]['value']}}{{$total - $discount}}</div>
                    </div>
                    @php
                    $fp = $total - $discount
                    @endphp
                    @if($fp <=0) <a href="{{ route('order.store',['payment'=>'Free','token'=>'Free']) }}"
                        class="chck-btn22" id="checkout-button">
                        {{__('Checkout Now')}}</a>
                        @endif
                        @if($fp > 0)
                        @if ($admin_setting[35]['value'] == 1)
                        <form method="POST" name="payflutterwave"
                            action="https://checkout.flutterwave.com/v3/hosted/pay">
                            <input type="hidden" name="public_key" value="{{$admin_setting[36]['value']}}" />
                            <input type="hidden" name="customer[email]" value="{{Auth::user()->email}}" />

                            <input type="hidden" name="customer[name]" value="{{Auth::user()->name}}" />
                            <input type="hidden" name="tx_ref" value="{{uniqid()}}" />
                            <input type="hidden" name="amount" value="{{($total - $discount)}}" />
                            <input type="hidden" name="currency" value="{{$admin_setting[6]->value}}" />
                            <input type="hidden" name="meta[token]" value="20" />
                            <input type="hidden" name="redirect_url"
                                value="{{ url('order/flutterwave') . '/'. uniqid()}}" />
                        </form>
                        @endif

                        @if ($admin_setting[22]['value'] == 1)
                        <button class="chck-btn22 mt-2" id="checkout-button">{{__('Pay With Stripe')}}</button>
                        @endif
                        @if ($admin_setting[25]['value'] == 1)
                            <button class="chck-btn22 mt-2" id="checkout-button-razorpay" onclick="razorpayPayment()">{{__('Pay With Razorpay')}}</button>
                        @endif
                        @if ($admin_setting[35]['value'] == 1)
                            <button class="chck-btn22 mt-2" id="checkout-button-flutterwave" onclick="paywitfluterwave()">{{__('Pay With flutterwave')}}</button>
                        @endif
                        @if ($admin_setting[39]['value'] == 1)
                        <button class="chck-btn22 mt-2" id="checkout-button-paystack"
                            onclick="payWithPaystack()">{{__('Pay With Paystack')}}</button>
                        @endif
                        @if ($admin_setting[37]['value'] == 1)
                        <button class="chck-btn22 mt-2" id="checkout-button-mollie"
                            onclick="window.location.href = '{{ $molliecu }}';">{{__('Pay With Mollie')}}</button>
                        @endif
                        @if ($admin_setting[20]['value'] == 1)
                            <div id="paypal-button-container" class="mt-2"></div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
</div>

@endsection

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script src="{{ asset('payment/paystack-v1.js') }}"></script>
<script src="https://www.paypal.com/sdk/js?client-id={{$admin_setting[21]['value']}}&components=buttons">
</script>
<script src="{{ asset('payment/razorpay-v1.js') }}"></script>
<script>
    "use strict";
    var paypal;
    paypal.Buttons({
        createOrder: function (data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '{{($total - $discount)}}'
                    }
                }]
            });
        },
        onApprove: (data, actions) => {

            actions.order.get().then(details => {

            });

        },
        onClientAuthorization: (data) => {
            console.log(
                'onClientAuthorization - you should probably inform your server about completed transaction at this point');
            window.location.href = `{{ url('order/paypal')}}/` + data.id
        },
        onCancel: (data, actions) => {


        },
        onError: err => {

        },
        onClick: (data, actions) => {

        },

    }).render('#paypal-button-container');
</script>
<script>

    function paywitfluterwave() {
        document.forms['payflutterwave'].submit()
    }

    function payWithPaystack() {
        var handler = PaystackPop.setup({
            key: "{{$admin_setting[40]['value']}}",
            email: "{{Auth::user()->email}}",
            amount: "{{($total - $discount) * 100}}",
            currency: "{{$admin_setting[6]->value}}",
            ref: Math.floor(Math.random() * (999999 - 111111)) + 999999,
            callback: function (response) {
                window.location.href = `{{ url('order/paystack')}}/` + response.reference


            },
            onClose: function () {
                alert('Transaction was not completed, window closed.');
            },
        });
        handler.openIframe();
    }

    function razorpayPayment() {
        var options = {
            "key": "{{$admin_setting[26]['value']}}",
            "amount": '{{($total - $discount) * 100}}',
            "name": `{{env("APP_NAME")}}`,
            "description": "Secure Payment with Razorpay",
            "image": "{{ asset('frontend/images/fav.png') }}",
            "handler": function (response) {

                window.location.href = `{{ url('order/razorpay')}}/` + response.razorpay_payment_id

            },
            "prefill": {
                "name": "",
                "email": '',
                "contact": ''
            },
            "notes": {
                "address": "address"
            },
            "theme": {
                "color": "#7209B7"
            }
        };

        var propay = new Razorpay(options);
        propay.open();
    }

    setTimeout(() => {
        var stripe = Stripe("{{$admin_setting[23]['value']}}");
        var checkoutButton = document.getElementById('checkout-button');

        checkoutButton.addEventListener('click', function () {
            stripe.redirectToCheckout({
                sessionId: '{{$stipesession}}'
            }).then(function (result) {

            });
        });
    }, 5000);

</script>
@endpush
