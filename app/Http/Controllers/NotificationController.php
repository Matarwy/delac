<?php

namespace App\Http\Controllers;

use App\Mail\CustomMail;
use App\Models\AdminSetting;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Notification;
use App\Models\NotiTemplate;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use OneSignal;
class NotificationController extends Controller
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        //
    }

    public function sendNotification($ids, $type)
    {
        $noti = NotiTemplate::find($type);
        if ($noti->for_who == 1) {
            $u = Student::find($ids['s_id']);
        } else {
            $u = Instructor::find($ids['i_id']);
        }
        if (isset($ids['c_id'])) {
            $c = Course::find($ids['c_id']);
        }
        if (isset($ids['s_id'])) {
            $s = Student::find($ids['s_id']);
        }
        if (isset($ids['i_id'])) {
            $i = Instructor::find($ids['i_id']);
        }
        $tag = ['{{student_name}}', '{{course_title}}', '{{instructor_name}}', '{{sell_date}}', '{{amount}}', '{{remark}}', '{{status}}', '{{review}}'];
        $replace = [$s->name ?? "", $c->title ?? "", $i->name ?? "", $ids['sell_date'] ?? "", $ids['amount'] ?? "", $ids['remark'] ?? "", $ids['status'] ?? "", $ids['review'] ?? ""];
        $noti_title = str_replace($tag, $replace, $noti->noti_title);
        $email_title = str_replace($tag, $replace, $noti->email_title);
        $subject = str_replace($tag, $replace, $noti->subject);
        Notification::create([
            'title' => $noti_title,
            'user_id' => $u->id,
            'who_is' => $noti->for_who
        ]);

        try {
            if ($u->email_notification == 1)
                Mail::to($u)->send(new CustomMail($email_title, $subject));
        } catch (\Throwable $th) {
        }
        if ($u->push_notification == 1 && isset($u->device_token)) {
            $this->oneplus($u->device_token, $noti_title);
        }
    }
    public function oneplus($userid, $sub)
    {

        try {
            OneSignal::sendNotificationToUser(
                $sub,
                $userid,
                $url = null,
                $data = null,
                $buttons = null,
                $schedule = null,
                $headings = null
            );
        } catch (\Throwable $th) {
        }
    }
}
