<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payout;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessController extends Controller
{
    //
    public function payout()
    {
        $payouts =   Payout::where('instructor_id', Auth::id())->get();
        return view('frontend.instructor.business.payout', compact('payouts'));
    }
    public function payoutStore(Request $request)
    {


        if (Auth::user()->balance < $request->amount) {
            return back()->withStatus(__('Please Enter valid amount.'));
        }
        $reqData = $request->all();
        $reqData['instructor_id'] = Auth::id();
        Payout::create($reqData);
        Auth::user()->decrement('balance', $reqData['amount']);
        return back()->withStatus(__('We Processing your request.'));
    }
    public function statements(Request $request)
    {

        $iid = Auth::id();
        $fir = Order::firstWhere('instructor_id', $iid)->created_at ?? Carbon::today();
        $result = CarbonPeriod::create($fir->toDateString(), '1 month', Carbon::today()->toDateString());
        $months = [];
        foreach ($result as $dt) {
            $months[]  = $dt->format("Y-m");
        }
        $today = isset($request->date) ? Carbon::parse($request->date) :  Carbon::today();
        $orders = Order::with('course:id,title')->where('instructor_id', $iid)->whereMonth('created_at', $today->format('m'))->whereYear('created_at', $today->format('Y'))->orderBy('created_at', 'desc')->get();


        $state['total'] =  $orders->sum('price');
        $state['commission'] = $orders->sum('admin_commission');
        $state['earning'] = $state['total'] - $state['commission'];

        return view('frontend.instructor.business.statement', compact('orders', 'months', 'state', 'today'));
    }
    public function earning(Request $request)
    {


        $iid = Auth::id();
        $fir = Order::firstWhere('instructor_id', $iid)->created_at ?? Carbon::today();
        $result = CarbonPeriod::create($fir->toDateString(), '1 month', Carbon::today()->toDateString());
        $months = [];
        foreach ($result as $dt) {
            $months[]  = $dt->format("Y-m");
        }
        $today = isset($request->date) ? Carbon::parse($request->date) :  Carbon::today();
        $orders = Order::with('course:id,title')->where('instructor_id', $iid)->whereMonth('created_at', $today->format('m'))->whereYear('created_at', $today->format('Y'))->orderBy('total', 'desc')
            ->selectRaw('course_id, count(*) as total,SUM(price) as totamount,FORMAT(SUM(admin_commission) ,2) as commission')
            ->groupBy('course_id')
            ->get();

        $state['total'] = $orders->sum('totamount');
        $state['commission'] = $orders->sum('commission');
        $state['earning'] = $orders->sum('totamount') -  $orders->sum('commission');
        $datewise = Order::where('instructor_id', $iid)->whereMonth('created_at', $today->format('m'))->whereYear('created_at', $today->format('Y'))->select("created_at")
            ->selectRaw(' count(*) as total,FORMAT(SUM(price) -  SUM(admin_commission)  ,2) as earning, DATE(created_at) as date')->groupBy('date')->orderBy('created_at', 'asc')
            ->get();
        $state['d_total'] = $datewise->sum('total');
        $state['d_earning'] = $datewise->sum('earning');
        return view("frontend.instructor.business.earning", compact('orders', 'state', 'datewise', 'months', 'today'));
    }
}
