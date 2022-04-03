<?php


namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\InsVerify;
use App\Models\Order;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gate;

use Symfony\Component\HttpFoundation\Response;

class InsVerifyController extends Controller
{



    public function dashboard()
    {

        $id = Auth::id();

        $master['course_count'] = Course::where('instructor_id', $id)->count();
        $master['course_count_d'] = Course::where('instructor_id', $id)->whereDate('created_at', Carbon::now())->count();
        $cid  = Course::where('instructor_id', $id)->get()->pluck('id');

        $orders = Order::whereIn('course_id', $cid)->get();
        $orderst = Order::whereIn('course_id', $cid)->whereDate('created_at', Carbon::now())->get();

        $master['total_sell'] = $orders->sum('price') - $orders->sum('admin_commission');
        $master['total_sell_d'] =  $orderst->sum('price') - $orderst->sum('admin_commission');
        $master['total_enroll'] = count($orders);
        $master['total_enroll_d'] =  count($orderst);
        $unique = $orders->unique('student_id');
        $uniquet = $orderst->unique('student_id');

        $master['total_student'] = $unique->values()->count();
        $master['total_student_d'] =  $uniquet->values()->count();

        $master['total_subscribers'] = Subscription::where('instructor_id', $id)->count();
        $master['total_subscribers_d'] = Subscription::where('instructor_id', $id)->whereDate('created_at', Carbon::now())->count();
        $master['review_c'] = Course::where([['instructor_id', $id], ['status', 0]])->latest()->get();
        $master['l_sell'] = $orders->take(5)->all();
        return view('frontend.instructor.dashboard', compact('master'));
    }

    public function analytics()
    {
        $iid = Auth::id();
        $master['course'] = Course::withCount(['enroll', 'reviews'])->where([['instructor_id', $iid], ['status', 1]])->get();
        $today = Carbon::today()->subMonths(11);
        $months = [];
        $subscriber  = [];
        $y_earning  = [];
        for ($i = 0; $i < 12; $i++) {
            $c  = Subscription::where('instructor_id', $iid)->whereMonth('created_at', $today->format('m'))->whereYear('created_at',  $today->format('Y'))->count();

            $o = Order::where('instructor_id', $iid)->whereMonth('created_at', $today->format('m'))->whereYear('created_at', $today->format('Y'))->select("created_at")
                ->selectRaw('count(*) as total,FORMAT(SUM(price) -  SUM(admin_commission) ,2) as earning')->groupBy('instructor_id')
                ->first();

            $months[] = $today->format('M');
            $subscriber[] = $c;
            $y_earning[] = $o->earning ?? 0;

            $today->addMonth();
        }

        $today = Carbon::today()->subDays(6);
        $days = [];
        $w_sell = [];
        $w_earning = [];
        for ($i = 0; $i < 7; $i++) {
            $o = Order::where('instructor_id', $iid)->whereMonth('created_at', $today->format('m'))->whereDay('created_at', $today)
                ->selectRaw('count(*) as total,FORMAT(SUM(price) -  SUM(admin_commission) ,2) as earning')->groupBy('instructor_id')
                ->first();
            $days[] = $today->format('D');
            $w_earning[] = $o->earning ?? 0;
            $w_sell[] = $o->total ?? 0;
            $today->addDay();
        }

        $master['months'] = $months;
        $master['subscriber'] = $subscriber;
        $master['days'] = $days;
        $master['w_earning'] = $w_earning;
        $master['y_earning'] = $y_earning;
        $master['w_sell'] = $w_sell;


        return view('frontend.instructor.analytics', compact('master'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        if (Auth::guard('instructor')->check()) {
            $vreq = InsVerify::firstWhere('instructor_id', Auth::id());
            $state['order'] =  Order::where('instructor_id', Auth::id())->count();
            $state['subscription'] =   Subscription::where('instructor_id', Auth::id())->count();
            return view("frontend.instructor.verification.index", compact('vreq', 'state'));
        }
        abort_if(Gate::denies('verification_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vreq = InsVerify::latest()->get();
        return view("admin.verification.index", compact('vreq'));
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
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => "bail|required",
            "document" => "bail|required|file|max:1024"
        ]);

        $reqData = $request->all();

        $reqData['instructor_id'] = Auth::id();
        $reqData['document'] = (new HelperController)->uploadfile($request->document, 'upload/document');
        InsVerify::create($reqData);

        return back()->withStatus(__('Your request are submitted successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InsVerify  $insVerify
     * @return \Illuminate\Http\Response
     */
    public function show(InsVerify $insVerify)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InsVerify  $insVerify
     * @return \Illuminate\Http\Response
     */
    public function edit(InsVerify $insVerify)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InsVerify  $insVerify
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        //
        if ($request->has('status')) {
            $status = $request->status;
            $ins = InsVerify::findOrFail($id);
            if ($status == 1) {
                Instructor::find($ins->instructor_id)->update(['verify_pro' => 1]);
            }
            $ins->status = $status;
            $ins->save();
        }
        return back()->withStatus(__('Request are updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InsVerify  $insVerify
     * @return \Illuminate\Http\Response
     */
    public function destroy(InsVerify $insVerify)
    {
        //
    }
}
