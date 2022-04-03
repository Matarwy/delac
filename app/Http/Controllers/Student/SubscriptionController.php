<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $q = $request->q ?? "";
        $id = Auth::id();
        $ids = Subscription::where('student_id', $id)->pluck('id');
        $instructors  = Instructor::whereIn('id', $ids)->where([['name', 'LIKE', '%' . $q . '%'], ['status', 1]])->orWhere([['headline', 'LIKE', '%' . $q . '%'], ['status', 1]])->paginate(12);
        $params = ['q' => $q];
        return view('frontend.student.instructor.index', compact('instructors', 'params'));
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
    public function store(Request $request, $id)
    {
        //
        $ud =  $request->user('student');
        if ($ud) {
            Subscription::updateOrCreate(['instructor_id' => $id, 'student_id' => $ud->id], ['student_id' => $ud->id]);
            return back()->withStatus(__('Subscribe successfully.'));
        } else {
            return back()->withStatus(__('Please login to subscribe.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        //
        $ud =  $request->user('student');
        if ($ud) {
            Subscription::where([['instructor_id', $id], ['student_id', $ud->id]])->delete();
            return back()->withStatus(__('Un-subscribe successfully.'));
        } else {
            return back()->withStatus(__('Please login to continue.'));
        }
    }
}
