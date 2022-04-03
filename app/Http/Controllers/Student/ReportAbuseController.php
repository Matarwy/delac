<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Models\Course;
use App\Models\ReportAbuse;
use Illuminate\Http\Request;

class ReportAbuseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $ud =  $request->user('student');
        if ($ud) {
            $reports =  ReportAbuse::with('course:id,title')->where('student_id', $ud->id)->latest()->get();
        } else {
            $reports = [];
        }
        return view("frontend.student.report", compact('reports'));
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
    public function store(Request $request, $id)
    {
        //
        $ud =  $request->user('student');
        if ($ud) {
            ReportAbuse::updateOrCreate(['course_id' => $id, 'student_id' => $ud->id], ['student_id' => $ud->id,'course_id' => $id]);

            
            $ids['s_id'] = $ud->id;
            $ids['c_id'] = $id;
            $res =  (new NotificationController)->sendNotification($ids, 7);
            Course::find($id)->increment('report_abues');
            return back()->withStatus(__('Thanks for reporting, we look of this.'));
        } else {
            return back()->withStatus(__('Please login to report course'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReportAbuse  $reportAbuse
     * @return \Illuminate\Http\Response
     */
    public function show(ReportAbuse $reportAbuse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReportAbuse  $reportAbuse
     * @return \Illuminate\Http\Response
     */
    public function edit(ReportAbuse $reportAbuse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReportAbuse  $reportAbuse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReportAbuse $reportAbuse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReportAbuse  $reportAbuse
     * @return \Illuminate\Http\Response
     */
}
