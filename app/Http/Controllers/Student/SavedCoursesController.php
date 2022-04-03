<?php


namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\SavedCourses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavedCoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $id = Auth::id();
        $cids = SavedCourses::where('student_id', $id)->latest()->get()->pluck('course_id');
        $courses = Course::with(['instructor:id,name', 'category:id,name', 'SubCategory:id,name'])->whereIn('id', $cids)->where('status', 1)->get();
        return view('frontend.student.course.saved', compact('courses'));
    }

    public function removeAll()
    {
        $id = Auth::id();
        $cids = SavedCourses::where('student_id', $id)->delete();
        return back()->withStatus(__('Your saved list has been removed'));
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
            SavedCourses::updateOrCreate(['course_id' => $id, 'student_id' => $ud->id], ['student_id' => $ud->id,'course_id' => $id]);
            return back()->withStatus(__('Added to saved.'));
        } else {
            return back()->withStatus(__('Please login to save course'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SavedCourses  $savedCourses
     * @return \Illuminate\Http\Response
     */
    public function show(SavedCourses $savedCourses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SavedCourses  $savedCourses
     * @return \Illuminate\Http\Response
     */
    public function edit(SavedCourses $savedCourses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SavedCourses  $savedCourses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SavedCourses $savedCourses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SavedCourses  $savedCourses
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        //
        $ud =  $request->user('student');
        if ($ud) {
            SavedCourses::where([['course_id', $id], ['student_id', $ud->id]])->delete();
            return back()->withStatus(__('Remove from saved list.'));
        } else {
            return back()->withStatus(__('Please login to continue.'));
        }
    }
}
