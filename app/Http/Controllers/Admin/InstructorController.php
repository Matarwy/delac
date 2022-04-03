<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Models\Course;
use App\Models\CourseRating;
use App\Models\Instructor;
use App\Models\Student;
use App\Models\Subscription;
use Illuminate\Http\Request;

use Gate;
use Symfony\Component\HttpFoundation\Response;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        abort_if(Gate::denies('instructor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instructors =   Instructor::all();
        return view('admin.instructors.index', compact('instructors'));
    }
    public function courseIndex($status)
    {
        abort_if(Gate::denies('course_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($status == "all") {
            $courses = Course::with('category:id,name')->latest()->get();
        } else if ($status == "pending") {
            $courses = Course::with('category:id,name')->where('status', 2)->latest()->get();
        } else if ($status == "rejected") {
            $courses = Course::with('category:id,name')->where('status', 4)->latest()->get();
        } else {
            abort(404);
        }
        return view('admin.courses.index', compact('courses'));
    }
    public function courseUpdate($id, Request  $request)
    {

        $course = Course::findOrFail($id);
        $ids['i_id'] = $course->instructor_id;
        $ids['c_id'] = $course->id;
        if ($request->status == 1) {
          
            $res =  (new NotificationController)->sendNotification($ids, 2);
        }
        if ($request->status == 3) {
          
            $res =  (new NotificationController)->sendNotification($ids, 8);
        }
        if ($request->status == 1 && $course->status == 2) {
        
            $sid = Subscription::where('instructor_id', $course->instructor_id)->get()->pluck('student_id');

            $student = Student::where('status', 1)->whereIn('id', $sid)->get();
            foreach ($student as $s) {

                $ids['i_id'] = $course->instructor_id;
                $ids['c_id'] =  $course->id;
                $ids['s_id'] =  $s->id;

                $res =  (new NotificationController)->sendNotification($ids, 10);
            }
        }

        $course->update($request->all());
        return back()->withStatus(__('Course is updated successfully.'));
    }

    public function courseShow($id)
    {
        $course = Course::findOrFail($id);
        $course->load(['subCategory:id,name', 'category:id,name', 'content', 'content.lectures', 'instructor:id,name,email,image', 'reviews', 'reviews.student']);
        return view('admin.courses.show', compact('course'));
    }
    public function reviewDelete($id)
    {
        CourseRating::find($id)->delete();
        return back()->withStatus(__('Review deleted successfully.'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function show(Instructor $instructor)
    {
        //
        $instructor->loadCount(['enroll', 'subscribers']);
        $instructor->load(['courses', 'discussions', 'enroll']);

        return view('admin.instructors.show', compact('instructor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function edit(Instructor $instructor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instructor $instructor)
    {
        //
        $instructor->update($request->all());
        return back()->withStatus(__('Instructor is updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instructor $instructor)
    {
        //
    }
}
