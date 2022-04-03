<?php


namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\InstructorDiscussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorDiscussionController extends Controller
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
        $reqData = $request->all();
        $reqData['student_id'] =  Auth::id();
        InstructorDiscussion::create($reqData);
        return back()->withStatus(__('Comment added.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InstructorDiscussion  $instructorDiscussion
     * @return \Illuminate\Http\Response
     */
    public function show(InstructorDiscussion $instructorDiscussion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InstructorDiscussion  $instructorDiscussion
     * @return \Illuminate\Http\Response
     */
    public function edit(InstructorDiscussion $instructorDiscussion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InstructorDiscussion  $instructorDiscussion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InstructorDiscussion $instructorDiscussion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InstructorDiscussion  $instructorDiscussion
     * @return \Illuminate\Http\Response
     */
    public function destroy(InstructorDiscussion $id)
    {
        //
        $id->delete();
        return back()->withStatus(__('Comment Delete Successful'));
    }

    public function storeLikeDislike($id, $action, Request $request)
    {

        $ud =  $request->user('student');

        if (!$ud) {
            return back()->withStatus(__('Please login.'));
        }
        $sid = $ud->id;
        $l = "likes";
        $d = "dislikes";
        if ($action != 'like') {
            $l = "dislikes";
            $d = "likes";
        }

        $ins = InstructorDiscussion::findOrFail($id);
        if (in_array($sid, $ins->$l)) {
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
            $di = array_search($sid, $ins->$d);
            if ($di > -1) {
                $te = $ins->$d;
                array_splice($te, $di, 1);
                $ins->$d = $te;
            }

            $temp = $ins->$l;
            array_push($temp, $sid);
            $ins->$l = $temp;
        }
        $ins->save();

        return back()->withStatus(__('Done'));
    }
}
