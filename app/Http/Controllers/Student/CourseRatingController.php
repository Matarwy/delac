<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Models\Course;
use App\Models\CourseRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $reqData = $request->all();
        $reqData['student_id'] = Auth::id();
        CourseRating::updateOrCreate(['student_id' => $reqData['student_id'], ['course_id', $reqData['course_id']]], $reqData);


        
        $ids['i_id'] = Course::find($reqData['course_id'])->instructor_id;
        $ids['s_id'] = $reqData['student_id'];
        $ids['review'] = $reqData['msg'];
        $ids['c_id'] = $reqData['course_id'];
        $res =  (new NotificationController)->sendNotification($ids, 5);
        $res =  (new NotificationController)->sendNotification($ids, 6);


        return back()->withStatus(__('Review Submitted successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CourseRating  $courseRating
     * @return \Illuminate\Http\Response
     */
    public function show(CourseRating $courseRating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CourseRating  $courseRating
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseRating $courseRating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CourseRating  $courseRating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CourseRating $courseRating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CourseRating  $courseRating
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourseRating $courseRating)
    {
        //
    }
}
