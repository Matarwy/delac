<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Models\CourseContent;
use App\Models\Lecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class CourseContentController extends Controller
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
        //


        $cid = $request->courseid;
        $cc = CourseContent::firstWhere('course_id', $cid);
        $po =  isset($cc->position) ? ($cc->position + 1) :  1;
        $data = CourseContent::create([
            'position' => $po,
            'course_id' => $cid,
            'title' => $request->title
        ]);
        $fillable = [
            'description', 'content_id', 'title', 'file', 'volume', 'duration', 'position', 'course_id'
        ];
        for ($i = 1; $i <= $request->lectures_length; $i++) {
            foreach ($fillable as $f) {
                $d = 'lectures_' . $i . '_';
                $d = $d . $f;
                if ($f == 'file') {
                    $name = (new HelperController)->uploadfile($request->$d, 'upload/lectures');
                    $create[$f] = $name;
                } else {
                    $create[$f] = $request->$d;
                }
            }
            $create['course_id'] = $cid;
            $create['content_id'] = $data->id;
            Lecture::create($create);
        }
        $lectures =  Lecture::where('content_id', $data->id)->get();
        $p = 1;
        foreach ($lectures as $lecture) {
            $lecture->position = $p;
            $p++;
            $lecture->save();
        }
        return response()->json(['msg' => 'Something went wrong.', 'data' => $data, 'success' => true], 200);
    }
    public function storeOnlyContent(Request $request)
    {
        $pos = CourseContent::where('course_id', $request->course_id)->latest()->first();
        $p = 0;
        if ($pos) {
            $p = $pos->position;
            $p++;
        }
        $reqData = $request->all();

        $reqData['position'] = $p;
        CourseContent::create($reqData);
        return back()->withStatus(__('Content added successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CourseContent  $courseContent
     * @return \Illuminate\Http\Response
     */
    public function show(CourseContent $courseContent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CourseContent  $courseContent
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseContent $courseContent)
    {
        //
        $courseContent->load('lectures');
        return view('frontend.instructor.course-content.edit', compact('courseContent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CourseContent  $courseContent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CourseContent $courseContent)
    {
        //
        $courseContent->update($request->all());
        return back()->withStatus('Course Content updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CourseContent  $courseContent
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourseContent $courseContent)
    {
        //

        $courseContent->lectures()->delete();
        $latest = $courseContent['position'];
        $res = array();
        $id = Session::get('courseid') ?? $courseContent->course_id;
        $cc = CourseContent::where('course_id', $id)->count();
        for ($i = $latest + 1; $i <= $cc; $i++) 
        {
            if(CourseContent::firstWhere([['position', $i], ['course_id', $id]]))
            {
                CourseContent::firstWhere([['position', $i], ['course_id', $id]])->decrement('position', 1);
            }
        }
        $courseContent->delete();

        return back()->withStatus(__('Course Content deleted'));
    }

    public function upSideDown(CourseContent $courseContent, $moved)
    {

        $cp = $courseContent->position;
        if ($moved == 'up') {
            $cp--;
            $mines = CourseContent::firstWhere([['position', $cp], ['course_id', $courseContent->course_id]]);
            $mines->increment('position', 1);
            $courseContent->decrement('position', 1);
        } else {
            $cp++;
            $mines = CourseContent::firstWhere([['position', $cp], ['course_id', $courseContent->course_id]]);
            $mines->decrement('position', 1);
            $courseContent->increment('position', 1);
        }

        return  back()->withStatus(__('Course Content position changed'));
    }
}
