<?php


namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Models\LiveStream;
use App\Models\Student;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LiveStreamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view("frontend.instructor.feedback.live");
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

        $reqData = $request->all();
        $reqData['instructor_id'] = Auth::id();
        $reqData['enable_comment'] = $request->enable_comment == 1 ? 1 : 0;
        LiveStream::create($reqData);
        Auth::user()->update(['is_live' => 1]);

        $sid = Subscription::where('instructor_id', $reqData['instructor_id'])->get()->pluck('student_id');

        $student = Student::where('status', 1)->whereIn('id', $sid)->get();
        foreach ($student as $s) {

            $ids['i_id'] = $reqData['instructor_id'];
            $ids['s_id'] =  $s->id;

            $res =  (new NotificationController)->sendNotification($ids, 9);
        }

        return back()->withStatus(__('You are live now.'));
    }

    public function streamEnd()
    {
        LiveStream::where('instructor_id', Auth::id())->update(['status' => 2]);
        Auth::user()->update(['is_live' => 0]);
        return back()->withStatus(__('Your Live stream end'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LiveStream  $liveStream
     * @return \Illuminate\Http\Response
     */
    public function show(LiveStream $liveStream)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LiveStream  $liveStream
     * @return \Illuminate\Http\Response
     */
    public function edit(LiveStream $liveStream)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LiveStream  $liveStream
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LiveStream $liveStream)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LiveStream  $liveStream
     * @return \Illuminate\Http\Response
     */
    public function destroy(LiveStream $liveStream)
    {
        //
    }
}
