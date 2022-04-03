@extends('frontend.layouts.ins-master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2 class="st_title"><i class="uil uil-wallet"></i> {{__('Payout')}}</h2>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-5">
        <div class="top_countries mt-30">
            <div class="top_countries_title">
                <h2>{{__('Available Amount')}}</h2>
            </div>
            <div class="payout_content">
                <span><strong>{{$admin_setting[7]['value']}}{{number_format(Auth::user()->balance,2)}}</strong></span>
                <div class="payout__via">
                    <strong></strong>
                </div>
                <p><small class="payout__small-notification">{{__('Your payout will be take')}} <strong>{{__('2 3 business
                            days')}}</strong></small></p>
            </div>
        </div>
        <div class="top_countries mt-30">
            <div class="top_countries_title">
                <h2>{{__('Payout Now')}}</h2>
            </div>
            <form action="{{ route('payout.store') }}" method="post">
                @csrf
                <div class="payout_content">
                    <div class="explore_search">
                        <div class="ui search focus">
                            <div class="ui   input swdh11 swdh15">
                                <input class="prompt srch_explore" type="number" placeholder="{{__('Enter Amount you payout')}}"
                                    name="amount" min="1" max="{{Auth::user()->balance}}" required>

                            </div>
                        </div>
                    </div>
                    <p><button type="submit" href="#" class="payout__btn">{{__('Set Account')}}</button></p>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-8 col-md-7">
        <div class="table-responsive mt-30">
            <table class="table ucp-table earning__table">
                <thead class="thead-s">
                    <tr>
                        <th scope="col">{{__('Amount')}}</th>
                        <th scope="col">{{__('Remark')}}</th>
                        <th scope="col">{{__('Status')}}</th>
                        <th scope="col">{{__('Last Update')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payouts as $payout)
                    <tr>
                        <td>{{$admin_setting[7]['value']}}{{number_format($payout->amount,2)}}</td>
                        <td>{{$payout->remark ?? '-'}}</td>
                        <td>

                                @if ($payout->status == 0)
                               <span class="text-primary"> {{__('Processing')}}
                                @elseif($payout->status == 1)
                                <span class="text-success"> {{__('Paid')}}
                                @else
                               <span class="text-danger"> {{__('Rejected')}}
                                @endif
                        </span>
                        </td>
                        <td>{{$payout->updated_at->format('d M Y')}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection