<?php

namespace App\Http\Controllers;

use App\Models\ChatGroup;
use App\Models\ChatMsg;
use App\Models\Instructor;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if (Auth::guard('student')->check()) {
            $lid =   Auth::id();
        } else {
            $lid = Auth::id();
        }

        if (Auth::guard('student')->check()) {
            $data =   ChatGroup::where('user_two', $lid)->get()->each->setAppends(['user', 'last_msg']);;
        } else {
            $data =  ChatGroup::where('user_one', $lid)->get()->each->setAppends(['user', 'last_msg']);;
        }
        $chat = 0;
        if (count($data) > 0) {
            $chat = $data[0];
            $chat->load(['messages']);
        }
       
        return view('frontend.student.messages.index', compact('data', 'chat'));
    }
    public function allUser($id)
    {
        
        $data = ChatGroup::where('user_two', $id)->orWhere('user_one', $id)->orderBy('last_chat', 'desc')->get()->each->setAppends(['user', 'last_msg']);
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }
    public function findUser(Request $request)
    {
      
        $user = User::firstOrCreate(
            ['name' => $request->name],
            $request->all()
        );
        $user['token'] = $user->createToken('user')->accessToken;
        return response()->json(['msg' => null, 'data' => $user, 'success' => true], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $data = ChatGroup::firstOrCreate(
            ['u_id' => $request->u_id],
            $request->all()
        );
        $data->load(['messages']);
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }
    public function savemsg(Request $request)
    {
      

        $data =  ChatMsg::create($request->all());
        ChatGroup::find($request->group_id)->update(['last_chat' => Carbon::now()]);
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }

    public function latestmsgajax(Request $request)
    {
        $messages = ChatMsg::where([['group_id', $request->gid], ['id', '>', $request->lastmsg ?? 0]])->get();
        $append = "";

        foreach ($messages as $msg) {
            $a = "";
            if (
                ($msg->sender_id == "student" && $request->guard == 'student') || ($msg->sender_id  == "instructor" && $request->guard == 'instructor')
            ) {
                $der = "der";
                $date = $msg->created_at->tz(\Session::get('timezone'))->format('D, M d, H:i:A');
                
                $a = "<div class='main-message-box ta-right'> <div class='message-dt float-right'><div class='message-inner-dt float-right'><p style='width: unset'>$msg->msg  </p></div> <br><span>$date</span></div></div>";
            } else {
                $date = $msg->created_at->tz(\Session::get('timezone'))->diffForHumans();
                $a = "<div class='main-message-box st3'><div class='message-dt st3'><div class='message-inner-dt'><p>$msg->msg</p></div><span>$date</span></div></div>";
            }
            $append .= $a;
        }
        $lastmsgid = $messages->last() ? $messages->last()->id : $request->lastmsg ?? 0;
        return response()->json(['msg' => null, 'data' =>  $append, 'success' => true, 'lastmsgid' => $lastmsgid], 200);
    }

    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChatGroup  $chatGroup
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::guard('student')->check()) {
            $lid =   Auth::id();
            $ou = Instructor::findOrFail($id);
            $gn = $lid . '-' . $ou->id;
            $data['user_one'] = $id;
            $data['user_two'] = $lid;
        } else {
            $lid = Auth::id();
            $ou = Student::findOrFail($id);
            $gn = $ou->id . '-' . $lid;
            $data['user_two'] = $id;
            $data['user_one'] = $lid;
        }

        $chat = ChatGroup::firstOrCreate(
            ['u_id' => $gn],
            $data
        );
        if (Auth::guard('student')->check()) {
            $data =   ChatGroup::where('user_two', $lid)->get()->each->setAppends(['user', 'last_msg']);;
        } else {
            $data =  ChatGroup::where('user_one', $lid)->get()->each->setAppends(['user', 'last_msg']);;
        }
        $chat->load(['messages']);
      
        return view('frontend.student.messages.index', compact('data', 'chat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChatGroup  $chatGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(ChatGroup $chatGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChatGroup  $chatGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChatGroup $chatGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChatGroup  $chatGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChatGroup $chatGroup)
    {
        //
    }
}
