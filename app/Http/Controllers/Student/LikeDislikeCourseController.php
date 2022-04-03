<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

use App\Models\Course;
use App\Models\LikeDislikeCourse;
use App\Models\LiveStream;
use App\Models\StreamComment;
use Illuminate\Http\Request;

class LikeDislikeCourseController extends Controller
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
    }


    public function streamComment(Request $request)
    {
        StreamComment::create($request->all());
        return "done";
    }
    public function streamCommentajax(Request $request)
    {
        $comment = StreamComment::where([['stream_id', $request->stream_id], ['id', '>', $request->lastcmt ?? 0]])->get();
        $append = "";
        foreach ($comment as $com) {
            $sname = $com->student->name ?? 'NO Data';
            $append .= "<p><a href='#'>$sname </a>$com->msg</p>";
        }
        $lastcmtid = $comment->last() ? $comment->last()->id : $request->lastcmt ?? 0;
        return response()->json(['msg' => null, 'data' =>  $append, 'success' => true, 'lastcmtid' => $lastcmtid], 200);
    }
    public function streamLikeDislike($id, $action, Request $request)
    {

        $ud =  $request->user('student');

        if (!$ud) {
            return back()->withStatus(__('Please login.'));
        }
        $sid = $ud->id;
        $l = "likes";
        $d = "dislikes";
        if ($action != 'likes') {
            $l = "dislikes";
            $d = "likes";
        }

        $ins = LiveStream::findOrFail($id);
        if (in_array($sid, $ins->$l ?? [])) {
            $i = array_search($sid, $ins->$l);
            $temp = $ins->$l;
            array_splice($temp, $i, 1);
            $ins->$l =  $temp;
            $di = array_search($sid, $ins->$d);
            if ($di > -1) {
                $te = $ins->$d;
                array_splice($te, $di, 1);
                $ins->$d = $te;
            }
        } else {
            $di = array_search($sid, $ins->$d ?? []);
            if ($di > -1) {
                $te = $ins->$d;
                array_splice($te, $di, 1);
                $ins->$d = $te;
            }

            $temp = $ins->$l ?? [];
            array_push($temp, $sid);
            $ins->$l = $temp;
        }
        $ins->save();

        return back()->withStatus(__('Done'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id, $what)
    {
        //
        $ud =  $request->user('student');
        $c = Course::find($id);

        if ($ud) {
            $d = LikeDislikeCourse::where([['course_id', $id], ['student_id', $ud->id]])->first();
            if ($d) {

                if ($d->for_what == 0)
                    $c->decrement('likes');
                else
                    $c->decrement('dislikes');

                $c = $c->fresh();

                if ($what == 0)
                    $c->increment('likes');
                else
                    $c->increment('dislikes');

                   
                $d->update(['for_what' => $what]);
            } else {
                LikeDislikeCourse::create([
                    'course_id' => $id,
                    'student_id' => $ud->id,
                    'for_what' => $what,
                ]);
                if ($what == 0)
                    $c->increment('likes');
                else
                    $c->increment('dislikes');
            }

            return back()->withStatus(__('Thank for your choice.'));
        } else {
            return back()->withStatus(__('Please login to save course'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LikeDislikeCourse  $likeDislikeCourse
     * @return \Illuminate\Http\Response
     */
    public function show(LikeDislikeCourse $likeDislikeCourse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LikeDislikeCourse  $likeDislikeCourse
     * @return \Illuminate\Http\Response
     */
    public function edit(LikeDislikeCourse $likeDislikeCourse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LikeDislikeCourse  $likeDislikeCourse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LikeDislikeCourse $likeDislikeCourse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LikeDislikeCourse  $likeDislikeCourse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $ud =  $request->user('student');
        if ($ud) {
            $da = LikeDislikeCourse::where([['course_id', $id], ['student_id', $ud->id]])->first();
            $c = Course::find($id);
            if ($da->for_what == 0)
                $c->decrement('likes');
            else
                $c->decrement('dislikes');
            $da->delete();
            return back()->withStatus(__('Thank for your choice.'));
        } else {
            return back()->withStatus(__('Please login to continue.'));
        }
    }
}
