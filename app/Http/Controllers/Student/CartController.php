<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\AdminSetting;
use App\Models\Cart;
use App\Models\Course;
use App\Models\SpecialDiscount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $as = AdminSetting::all();
        $stipesession = "";
        $molliecu = "";
        $total = 0;
        $discount = 0;
        $master = [];
        $stipeitem = [];
        $cs = Cart::where('student_id', Auth::id())->latest()->get()->pluck('course_id');
        $courses = Course::whereIn('id', $cs)->whereStatus(1)->get();
        if (count($courses) == 0) {
            return view("frontend.student.course.cart", compact('courses', 'total', 'discount', 'stipesession', 'molliecu'));
        }

        foreach ($courses as $course) {

            $fp = 0;
            if ($course->is_free == 0) {
                $sd = SpecialDiscount::where('course_id', $course->id)->orderBy('percentage', 'desc')->get()->filter(function ($item) {
                    if (Carbon::now()->between($item->start_time, $item->end_time)) {
                        return $item;
                    }
                })->first();
                if (!$sd) {

                    if ($course->discount_price > 0 && $course->discount_price < $course->price) {
                        $course->discount_price;
                        $d = $course->price - $course->discount_price;

                        $discount += $d;
                        $total += $course->price;
                        array_push($master, [
                            "instructor_id" => $course->instructor_id,
                            "course_id" => $course->id,
                            "price" => $course->discount_price,
                        ]);
                        $fp = $course->discount_price;
                    } else {
                        array_push($master, [
                            "instructor_id" => $course->instructor_id,
                            "course_id" => $course->id,
                            "price" => $course->price,
                        ]);
                        $total += $course->price;
                        $fp = $course->price;
                    }
                } else {
                    $dis = ($sd->percentage / 100) * $course->price;
                    $d = $course->price - $dis;
                    $course->discount_price = $d;
                    $discount += $dis;
                    $fp = $d;

                    $total += $course->price;
                    array_push($master, [
                        "instructor_id" => $course->instructor_id,
                        "course_id" => $course->id,
                        "price" => $d,
                    ]);
                    $course->spedis = $sd;
                }
            } else {
                array_push($master, [
                    "instructor_id" => $course->instructor_id,
                    "course_id" => $course->id,
                    "price" => 0,
                ]);
            }

            if ($fp > 0) {

                $si = [
                    'price_data' => [
                        'currency' => $as[6]->value,
                        'unit_amount' => $fp * 100,
                        'product_data' => [
                            'name' => $course->title,
                            'images' => [asset($course->cover_image)],
                        ],
                    ],
                    'quantity' => 1,
                ];
                $stipeitem[] = $si;
            }

        }

        Session::put('cart', $master);
        if ($as['22']['value'] == 1 && count($stipeitem) > 0) {

            \Stripe\Stripe::setApiKey($as['24']['value']);
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card', 'alipay'],
                'mode' => 'payment',
                'line_items' => $stipeitem,

                'success_url' => url("success") . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => url("cart"),
            ]);
            $stipesession = $session->id;
        }
        if ($as['37']['value'] == 1) {
            try {
                $mollie = new \Mollie\Api\MollieApiClient();
                $mollie->setApiKey($as['38']['value']);
                $payment = $mollie->payments->create([
                    "amount" => [
                        "currency" => $as[6]->value,
                        "value" => number_format((int) 500, 2, '.', ''),
                    ],
                    "description" => "Order #" . mt_rand(1111, 9999),
                    "redirectUrl" => url('order/mollie/' . mt_rand(1111, 9999)),

                ]);
                $molliecu = $payment->getCheckoutUrl();

                Session::put('mollieid', $payment->id);
            } catch (\Throwable $th) {
                //throw $th;
                $molliecu = "";
            }

        }

        return view("frontend.student.course.cart", compact('courses', 'total', 'discount', 'stipesession', 'molliecu'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id, $from = "")
    {
        //
        $ud = $request->user('student');
        if ($ud) {
            Cart::updateOrCreate(['course_id' => $id, 'student_id' => $ud->id], ['student_id' => $ud->id]);
            if($from == 'buy') {
                return \Redirect::route('cart');
            } else {
                return back()->withStatus(__('Added to cart.'));
            }

        } else {
            return back()->withStatus(__('Please login to add to cart.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        //
        $userdata = $request->user('student');
        if ($userdata) {
            Cart::where([['course_id', $id], ['student_id', $userdata->id]])->delete();
            return back()->withStatus(__('Courses remove from cart.'));
        } else {
            return back()->withStatus(__('Please login to continue.'));
        }
    }
}
