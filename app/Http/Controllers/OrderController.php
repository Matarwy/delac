<?php

namespace App\Http\Controllers;

use App\Models\AdminSetting;
use App\Models\Cart;
use App\Models\Instructor;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders = Order::with(['course', 'course.instructor', 'course.category', 'course.subCategory'])->where('student_id', Auth::id())->get();
        return view('frontend.student.course.buylist', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function invoice($id)
    {
        $order = Order::findOrFail($id);
        $order->load(['course', 'student']);
        return view('frontend.student.invoice', compact('order'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $payment, $token)
    {
        //
        if ($payment == 'mollie') {
            $mollie = new \Mollie\Api\MollieApiClient();
            $token = Session::get('mollieid');
            $molliekey = AdminSetting::find(39)->value;
            $mollie->setApiKey($molliekey);

            $payment = $mollie->payments->get($token);
            Session::forget('mollieid');

            if ($payment->isPaid()) {
            } else {
                return redirect('cart')->withStatus("Payment is not complete with Mollie");
            }
        }
        if ($payment == 'flutterwave') {
            if ($request->input('status') == 'successful') {
                $token = $request->input('transaction_id');
            } else {
                return redirect('cart')->withStatus("Payment is " . $request->input('status') . ' with flutterwave');
            }
        }
        $com = AdminSetting::find(6)->value;
        $cart = Session::get('cart');
        $id = Auth::id();
        foreach ($cart as $c) {
            $c['admin_commission'] = ($c['price'] * $com) / 100;
            $c['payment_method'] = $payment;
            $c['payment_token'] = $token;
            $c['student_id'] = $id;
            $c['uid'] = 'ord-' . substr(md5("", true), 6, 10);
            Order::create($c);
            Instructor::find($c['instructor_id'])->increment('balance', $c['price'] - $c['admin_commission']);
            $ids['i_id'] = $c['instructor_id'];
            $ids['sell_date'] = Carbon::today();
            $ids['c_id'] = $c['course_id'];
            $res = (new NotificationController)->sendNotification($ids, 3);
        }
        Cart::where('student_id', $id)->delete();
        Session::forget('cart');
        return redirect('thank-you')->withStatus("Purchases success");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
