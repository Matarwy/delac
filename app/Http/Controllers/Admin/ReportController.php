<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Order;
use App\Models\Student;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;
class ReportController extends Controller
{
    //
    public function studentReg(Request $request)
    {
        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->has('from') && $request->has('to')) {
            $students = Student::whereBetween('created_at', [$request->from . ' 00:00:01', $request->to . ' 23:59:59'])->latest()->get();
        } else {

            $students = Student::latest()->get();
        }
        return view('admin.reports.studentreg', compact('students'));
    }
    public function instructorReg(Request $request)
    {        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->has('from') && $request->has('to')) {
            $instructor = Instructor::whereBetween('created_at', [$request->from . ' 00:00:01', $request->to . ' 23:59:59'])->latest()->get();
        } else {

            $instructor = Instructor::latest()->get();
        }
        return view('admin.reports.instructorreg', compact('instructor'));
    }
    public function subscription(Request $request)
    {        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = Subscription::with(['student:id,name', 'instructor:id,name']);
        if ($request->has('from') && $request->has('to')) {
            $data->whereBetween('created_at', [$request->from . ' 00:00:01', $request->to . ' 23:59:59'])->latest()->get();
        }
        if ($request->has('ins_id')) {
            $data->whereIn('instructor_id', $request->ins_id);
        }
        $data = $data->latest()->get();
        $inst = Instructor::get();
        return view('admin.reports.subscription', compact('data', 'inst'));
    }
    public function courseSell(Request $request)
    {        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = Order::with(['student:id,name', 'course:id,title']);
        if ($request->has('from') && $request->has('to')) {
            $data->whereBetween('created_at', [$request->from . ' 00:00:01', $request->to . ' 23:59:59'])->latest()->get();
        }
        if ($request->has('ins_id')) {
            $data->whereIn('course_id', $request->ins_id);
        }
        $data = $data->latest()->get();
        $course = Course::get();
        return view('admin.reports.coursesell', compact('data', 'course'));
    }
    public function earning(Request $request)
    {        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = Order::with('instructor:id,name')->select('instructor_id', 'created_at')->selectRaw('count(*) as total,FORMAT(SUM(price) -  SUM(admin_commission) ,2) as earning,FORMAT(SUM(admin_commission) ,2) as ac')->groupBy('instructor_id')->orderBy('total', 'desc');
        if ($request->has('from') && $request->has('to')) {
            $data->whereBetween('created_at', [$request->from . ' 00:00:01', $request->to . ' 23:59:59'])->latest()->get();
        }
        if ($request->has('ins_id')) {
            $data->whereIn('course_id', $request->ins_id);
        }
        $data = $data->latest()->get();
        $inst = Instructor::get();
        return view('admin.reports.earning', compact('data', 'inst'));
    }
}
