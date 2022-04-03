<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseContent;
use App\Models\CourseRating;
use App\Models\Language;
use App\Models\Lecture;
use App\Models\Order;
use App\Models\SpecialDiscount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Course::withCount(['content', 'enroll'])->with('category:id,name')->where('instructor_id', Auth::id())->get();
        $draft = $data->where('status', 0)->all();
        $upcoming = $data->where('status', 2)->all();
        $active = $data->where('status', 1)->all();

        $reqData['instructor_id'] = Auth::id();
        $discount = SpecialDiscount::with('course:title,id')->latest()->where('instructor_id', Auth::id())->get();
        return view('frontend.instructor.courses.index', compact('upcoming', 'data', 'draft', 'active', 'discount'));
    }

    public function allReview()
    {
        $ids = Course::where('instructor_id', Auth::id())->get(['id'])->pluck('id');
        $reviews = CourseRating::with(['course:id,title', 'student:id,name,image'])->whereIn('course_id', $ids)->get();
        $totr = count($reviews);
        $state['avg_rating'] = 0;
        $state['5_star'] = 0;
        $state['4_star'] = 0;
        $state['3_star'] = 0;
        $state['2_star'] = 0;
        $state['1_star'] = 0;
        if ($totr > 0) {
            $state['avg_rating'] = $reviews->sum('star') / $totr;
            if ($totr > 0) {
                for ($i = 1; $i <= 5; $i++) {
                    # code...
                    $index = $i . '_star';
                    $state[$index] = round(($reviews->where('star', $i)->count() * 100) / $totr);
                }
            }
        }
        return view('frontend.instructor.courses.review', compact('reviews', 'state'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $currantstep = Session::has('currantstep') ? Session::get('currantstep') : 0;
        if ($currantstep == 0) {
            Session::forget('courseid');
            Session::put('currantstep', 0);
        }

        $languages = Language::whereStatus(1)->get();
        $category = Category::whereStatus(1)->get();
        $course_content = CourseContent::withCount('lectures')->where('course_id', Session::get('courseid'))->get();
        return view('frontend.instructor.courses.create', compact('currantstep', 'category', 'languages', 'course_content'));
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
        $request->validate([
            'title' => 'bail|required|min:10|max:60',
            'subtitle' => 'bail|required|min:10|max:120',
            'description' => 'bail|required|min:10',
            'price' => "bail|required_if:is_free, ==, 0",
            'category_id' => "bail|required",
            'subcategory_id' => "bail|required",
            'language_id' => "bail|required",
        ]);

        $reqData = $request->all();
        $reqData['instructor_id'] = Auth::id();
        $data = Course::create($reqData);
        $currantstep = 1;
        Session::put('currantstep', 1);
        Session::put('courseid', $data['id']);
        return back()->withStatus(__('Course created, please fill step 2.'));
    }

    public function updateStatus($id, $status)
    {
        $course = Course::where([['instructor_id', Auth::id()], ['id', $id]])->firstOrFail();
        $course->status = $status;
        $course->save();
        return back()->withStatus(__('Updated successfully'));
    }

    public function updateMedia(Request $request)
    {
        if (!$request->courseid) {
            Session::forget('courseid');
            Session::put('currantstep', 0);
            return back()->withStatus(__('Something went wrong.'));
        }
        $course = Course::where([['instructor_id', Auth::id()], ['id', $request->courseid]])->firstOrFail();

        $request->validate([
            'cover_image' => 'bail|required|file|image|max:1024',
            'promotional_video' => 'bail|required|file|max:5120',
        ]);

        $course->cover_image = (new HelperController)->uploadfile($request->cover_image, 'upload/image');

        $course->promotional_video = (new HelperController)->uploadfile($request->promotional_video, 'upload/video');
        $course->update();
        Session::put('currantstep', 2);
        return back()->withStatus(__('Media uploaded, please fill step 3.'));
    }
    public function updateSession(Request $request)
    {
        $cid = Session::get('courseid');

        $c = Lecture::where('course_id', $cid)->count();
        if ($c <= 0) {
            return back()->withStatus(__('Please add at least one lecture.'));
        }
        Session::put('currantstep', $request->currantstep);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //

        $languages = Language::whereStatus(1)->get();
        $category = Category::whereStatus(1)->get();
        $course_content = CourseContent::withCount('lectures')->where('course_id', $course->id)->get();

        return view('frontend.instructor.courses.edit', compact('languages', 'category', 'course', 'course_content'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //

        Session::forget('courseid');
        Session::forget('currantstep');
        $course->update($request->all());
        return redirect()->route('courses.index')->withStatus(__('Courses successfully added.'));
    }

    public function fullUpdate(Request $request, Course $course)
    {
        $request->validate([
            'cover_image' => 'bail|sometimes|file|image|max:1024',
            'promotional_video' => 'bail|sometimes|file|max:5120',
            'title' => 'bail|sometimes|min:10|max:60',
            'subtitle' => 'bail|sometimes|min:10|max:120',
            'description' => 'bail|sometimes|min:10',
            'category_id' => "bail|sometimes",
            'subcategory_id' => "bail|sometimes",
            'language_id' => "bail|sometimes",
        ]);

        $reqData = $request->all();
        if ($request->has('cover_image') && $request->cover_image) {
            $reqData['cover_image'] = (new HelperController)->uploadfile($request->cover_image, 'upload/image');
        }

        if ($request->has('promotional_video') && $request->promotional_video) {
            $reqData['promotional_video'] = (new HelperController)->uploadfile($request->promotional_video, 'upload/video');
        }

        $course->update($reqData);
        return back()->withStatus(__('Courses  updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {

        $c = Order::where('course_id', $course->id)->count();
        if ($c > 0) {
            return back()->withStatus(__('Course cant be deleted you can change status.'));
        }

        CourseContent::where('course_id', $course->id)->delete();
        $lecture =  Lecture::where('course_id', $course->id)->get();
        if(count($lecture) > 0)
        {
            if(isset($lecture->lectures))
            {
                foreach ($lecture->lectures as  $value) {
                    $delete =  (new HelperController)->deleteImage($value->file);
                    $value->delete();
                }
            }
        }
        $delete =  (new HelperController)->deleteImage($course->cover_image);
        $delete =  (new HelperController)->deleteImage($course->promotional_video);
        $course->delete();
        return back()->withStatus(__('Courses deleted successfully.'));
    }
}
