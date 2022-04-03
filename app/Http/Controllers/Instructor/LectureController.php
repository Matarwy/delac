<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Models\CourseContent;;

use App\Models\Lecture;
use Illuminate\Http\Request;

class LectureController extends Controller
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
        $pos = Lecture::where('content_id', $request->content_id)->latest()->first();
        $p = 0;
        if ($pos) {
            $p = $pos->position;
            $p++;
        }
        $reqData = $request->all();
        $reqData['file'] = (new HelperController)->uploadfile($request->file, 'upload/lectures');
        $reqData['position'] = $p;
        Lecture::create($reqData);
        return back()->withStatus(__('Lecture added successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function show(Lecture $lecture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function edit(Lecture $lecture)
    {
        return view('frontend.instructor.lecture.edit', compact('lecture'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lecture $lecture)
    {
        //
        $reqData = $request->all();
        if ($request->has('file') && $request->file) {
            $reqData['file'] =  (new HelperController)->uploadfile($request->file, 'upload/lectures');
        } else {
            $reqData['file'] = $lecture->file;
        }
        $lecture->update($reqData);
        return redirect()->route('course-content.edit', ['course_content' => $lecture->content_id])->withStatus(__('Lecture updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lecture $lecture)
    {
        //
        $id =  $lecture->content_id;
        $latest = $lecture->position;
        $cc = Lecture::where('content_id', $id)->count();
        for ($i = $latest + 1; $i <= $cc; $i++) {
            # code...
            Lecture::firstWhere([['position', $i], ['content_id', $id]])->decrement('position', 1);
        }
        $lecture->delete();
        return  back()->withStatus(__('Lecture deleted'));
    }
    public function upSideDown(Lecture $lecture, $moved)
    {

        $cp = $lecture->position;
        if ($moved == 'up') {
            $cp--;
            $mines = Lecture::firstWhere([['position', $cp], ['content_id', $lecture->content_id]]);
            $mines->increment('position', 1);
            $lecture->decrement('position', 1);
        } else {
            $cp++;
            $mines = Lecture::firstWhere([['position', $cp], ['content_id', $lecture->content_id]]);
            $mines->decrement('position', 1);
            $lecture->increment('position', 1);
        }

        return  back()->withStatus(__('Lecture position changed'));
    }
}
