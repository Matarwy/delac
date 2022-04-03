<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\AdminSetting;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseRating;
use App\Models\Instructor;
use App\Models\Language;
use App\Models\Lecture;
use App\Models\LikeDislikeCourse;
use App\Models\LiveStream;
use App\Models\Order;
use App\Models\ReportAbuse;
use App\Models\SavedCourses;
use App\Models\SpecialDiscount;
use App\Models\StreamComment;
use App\Models\Subscription;
use App\Models\User;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function index()
    {
        if (!env('DB_USERNAME')) {
            return view("license.setupl");
        }
        $seo = AdminSetting::whereIn('id', [28, 29, 30, 31, 32])->get();
        
        JsonLdMulti::setTitle($seo[0]['value'] ?? env('APP_NAME'));
        SEOTools::twitter()->setTitle($seo[0]['value'] ?? env('APP_NAME'));
        SEOMeta::setTitle($seo[0]['value'] ?? env('APP_NAME'));
        SEOTools::setTitle($seo[0]['value'] ?? env('APP_NAME'));

        JsonLdMulti::setDescription($seo[1]['value'] ?? null);
        SEOMeta::setDescription($seo[1]['value'] ?? null);
        SEOTools::setDescription($seo[1]['value'] ?? null);

        SEOMeta::addKeyword($seo[2]['value'] ?? null);
        SEOTools::opengraph()->addProperty('keywords', $seo[2]['value'] ?? null);

        JsonLdMulti::addImage(asset('frontend/images/seoimage.png'));
        SEOTools::opengraph()->addProperty('image', asset('frontend/images/seoimage.png'));
        SEOTools::jsonLd()->addImage(asset('frontend/images/seoimage.png'));

        SEOTools::setCanonical($seo[4]['value'] ?? url('/'));

        $coursesfeatured = Course::with(['instructor:id,name', 'category:id,name', 'SubCategory:id,name'])->where([['status', 1], ['is_featured', 1]])->inRandomOrder()->limit(10)->get();
        $courses = Course::with(['instructor:id,name', 'category:id,name', 'SubCategory:id,name'])->where('status', 1)->latest()->limit(10)->get();
        $instructors = Instructor::withCount(['courses', 'enroll'])->where([['status', 1], ['popular', 1]])->inRandomOrder()->limit(10)->get();
        $streams = Instructor::where([['is_live', 1], ['status', 1]])->inRandomOrder()->limit(10)->get();

        $inst = Instructor::withCount(['courses', 'enroll'])->where('status', 1)->inRandomOrder()->first();

        $ratting = CourseRating::with('student:id,name,image')->latest()->limit(10)->get();
        return view('frontend.student.index', compact('courses', 'instructors', 'streams', 'coursesfeatured', 'ratting', 'inst'));
    }

    public function filter(Request $request)
    {

        $seo = AdminSetting::whereIn('id', [28, 29, 30, 31, 32])->get();

        JsonLdMulti::setTitle('Filter - ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOTools::twitter()->setTitle('Filter - ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOMeta::setTitle('Filter - ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOTools::setTitle('Filter - ' . env('APP_NAME') ?? env('APP_NAME'));

        JsonLdMulti::setDescription($seo[1]['value'] ?? null);
        SEOMeta::setDescription($seo[1]['value'] ?? null);
        SEOTools::setDescription($seo[1]['value'] ?? null);

        SEOMeta::addKeyword($seo[2]['value'] ?? null);
        SEOTools::opengraph()->addProperty('keywords', $seo[2]['value'] ?? null);

        JsonLdMulti::addImage(asset('frontend/images/seoimage.png'));
        SEOTools::opengraph()->addProperty('image', asset('frontend/images/seoimage.png'));
        SEOTools::jsonLd()->addImage(asset('frontend/images/seoimage.png'));

        SEOTools::setCanonical($seo[4]['value'] ?? url('/'));

        $q = $request->q ?? "";
        $cat = $request->category ?? "";
        $lan = $request->language ?? "";
        $price = $request->price ?? 2;
        $rating = $request->rating ?? "";
        $duration = $request->duration ?? "";
        $sort = $request->sort ?? 1;
        $courses = Course::with(['instructor:id,name', 'category:id,name', 'SubCategory:id,name'])->where('status', 1)->where('title', 'LIKE', '%' . $q . '%');
        if ($cat) {
            $courses->where('category_id', $cat);
        }

        if ($lan) {
            $courses->where('language_id', $lan);
        }

        if ($price == 1) {
            $courses->where('is_free', 0);
        }

        if ($price == 0) {
            $courses->where('is_free', 1);
        }

        if ($sort == 1) {
            $courses->orderBy('created_at', 'desc');
        } elseif ($sort == 2) {
            $courses->orderBy('price', 'asc')->orderBy('discount_price', 'asc');
        } elseif ($sort == 3) {
            $courses->orderBy('price', 'desc')->orderBy('discount_price', 'desc');
        }
        $category = Category::where('status', 1)->get();
        $language = Language::where('status', 1)->get();
        $params = ['q' => $q, 'category' => $cat, 'language' => $lan, 'price' => $price, 'duration' => $duration, 'rating' => $rating, 'sort' => $sort];
        if ($rating || $duration) {
       
            $courses = $courses->get();
            if ($rating) {

                $courses = $courses->filter(function ($item) use ($rating) {
                    return $item->avg_rating >= (float) $rating;
                });
            }
            if ($duration) {
                $d = explode("-", $duration);
                $courses = $courses->filter(function ($item) use ($d) {
                    if ($item->duration >= $d[0] && $item->duration <= $d[1]) {
                        return $item;
                    }
                });
            }
            $ids = $courses->pluck('id');

            $courses = Course::whereIn('id', $ids);
            if ($sort == 1) {
                $courses->orderBy('created_at', 'desc');
            } elseif ($sort == 2) {
                $courses->orderBy('price', 'asc')->orderBy('discount_price', 'asc');
            } elseif ($sort == 3) {
                $courses->orderBy('price', 'desc')->orderBy('discount_price', 'desc');
            }
            $courses = $courses->paginate(12);
        } else {
            $courses = $courses->paginate(12);
        }
        return view('frontend.student.course.filter', compact('courses', 'params', 'language', 'category'));
    }

    public function instructorAll(Request $request)
    {
        $seo = AdminSetting::whereIn('id', [28, 29, 30, 31, 32])->get();

        JsonLdMulti::setTitle('Instructor Teaching on - ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOTools::twitter()->setTitle('Instructor Teaching on - ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOMeta::setTitle('Instructor Teaching on - ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOTools::setTitle('Instructor Teaching on - ' . env('APP_NAME') ?? env('APP_NAME'));

        JsonLdMulti::setDescription($seo[1]['value'] ?? null);
        SEOMeta::setDescription($seo[1]['value'] ?? null);
        SEOTools::setDescription($seo[1]['value'] ?? null);

        SEOMeta::addKeyword($seo[2]['value'] ?? null);
        SEOTools::opengraph()->addProperty('keywords', $seo[2]['value'] ?? null);

        JsonLdMulti::addImage(asset('frontend/images/seoimage.png'));
        SEOTools::opengraph()->addProperty('image', asset('frontend/images/logo.svg'));
        SEOTools::jsonLd()->addImage(asset('frontend/images/seoimage.png'));

        SEOTools::setCanonical($seo[4]['value'] ?? url('/'));

        $q = $request->q ?? "";
        $instructors = Instructor::withCount(['courses', 'enroll'])->where([['name', 'LIKE', '%' . $q . '%'], ['status', 1]])->orWhere([['headline', 'LIKE', '%' . $q . '%'], ['status', 1]])->inRandomOrder()->paginate(12);
        $params = ['q' => $q];
        return view('frontend.student.instructor.index', compact('instructors', 'params'));
    }
    public function instructorShow($slug, $id, Request $request)
    {

        $inst = Instructor::findOrFail($id);
        $seo = AdminSetting::whereIn('id', [28, 29, 30, 31, 32])->get();

        JsonLdMulti::setTitle($inst->name . '-' . $inst->headline . ' is on ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOTools::twitter()->setTitle($inst->name . '-' . $inst->headline . ' is on ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOMeta::setTitle($inst->name . '-' . $inst->headline . ' is on ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOTools::setTitle($inst->name . '-' . $inst->headline . ' is on ' . env('APP_NAME') ?? env('APP_NAME'));

        JsonLdMulti::setDescription($seo[1]['value'] ?? null);
        SEOMeta::setDescription($seo[1]['value'] ?? null);
        SEOTools::setDescription($seo[1]['value'] ?? null);

        SEOMeta::addKeyword($seo[2]['value'] ?? null);
        SEOTools::opengraph()->addProperty('keywords', $seo[2]['value'] ?? null);

        JsonLdMulti::addImage(asset($inst->image));
        SEOTools::opengraph()->addProperty('image', asset($inst->image));
        SEOTools::jsonLd()->addImage(asset($inst->image));

        SEOTools::setCanonical($seo[4]['value'] ?? url('/'));
        $inst->loadCount(['enroll', 'subscribers']);
        $inst->load(['courses' => function ($query) {
            $query->where('status', 1);
        }, 'discussions']);
        $ud = $request->user('student');
        $cisd = $inst->courses->pluck('id');
        $crc = CourseRating::whereIn('course_id', $cisd)->count();
        $inst['ins_sub'] = 0;
        $inst['crc'] = $crc;
        if ($ud) {
            $s = Subscription::firstWhere([['instructor_id', $id], ['student_id', $ud->id]]);
            $inst['ins_sub'] = $s ? 1 : 0;
        }
        return view('frontend.student.instructor.show', compact('inst'));
    }
    public function coursesAll(Request $request, $type = "")
    {
        $seo = AdminSetting::whereIn('id', [28, 29, 30, 31, 32])->get();

        JsonLdMulti::setTitle('Find courses on  ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOTools::twitter()->setTitle('Find courses on  ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOMeta::setTitle('Find courses on  ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOTools::setTitle('Find courses on  ' . env('APP_NAME') ?? env('APP_NAME'));

        JsonLdMulti::setDescription($seo[1]['value'] ?? null);
        SEOMeta::setDescription($seo[1]['value'] ?? null);
        SEOTools::setDescription($seo[1]['value'] ?? null);

        SEOMeta::addKeyword($seo[2]['value'] ?? null);
        SEOTools::opengraph()->addProperty('keywords', $seo[2]['value'] ?? null);

        JsonLdMulti::addImage(asset('frontend/images/seoimage.png'));
        SEOTools::opengraph()->addProperty('image', asset('frontend/images/logo.svg'));
        SEOTools::jsonLd()->addImage(asset('frontend/images/seoimage.png'));

        SEOTools::setCanonical($seo[4]['value'] ?? url('/'));

        $q = $request->q ?? "";
        if ($type == "featured") {

            $courses = Course::with(['instructor:id,name', 'category:id,name', 'SubCategory:id,name'])->where([['status', 1], ['is_featured', 1]])->where('title', 'LIKE', '%' . $q . '%')->paginate(12);
        } elseif ($type == "latest") {

            $courses = Course::with(['instructor:id,name', 'category:id,name', 'SubCategory:id,name'])->where('status', 1)->latest()->where('title', 'LIKE', '%' . $q . '%')->paginate(12);
        } else {

            $courses = Course::with(['instructor:id,name', 'category:id,name', 'SubCategory:id,name'])->where('status', 1)->where('title', 'LIKE', '%' . $q . '%')->paginate(12);
        }

        $params = ['q' => $q];

        return view('frontend.student.course.index', compact('courses', 'params'));
    }
    public function courseShow($slug, $id, Request $request)
    {
        $course = Course::findOrFail($id);
        $seo = AdminSetting::whereIn('id', [28, 29, 30, 31, 32])->get();

        JsonLdMulti::setTitle($course->title . ' is on ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOTools::twitter()->setTitle($course->title . ' is on ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOMeta::setTitle($course->title . ' is on ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOTools::setTitle($course->title . ' is on ' . env('APP_NAME') ?? env('APP_NAME'));

        JsonLdMulti::setDescription($seo[1]['value'] ?? null);
        SEOMeta::setDescription($seo[1]['value'] ?? null);
        SEOTools::setDescription($seo[1]['value'] ?? null);

        SEOMeta::addKeyword($seo[2]['value'] ?? null);
        SEOTools::opengraph()->addProperty('keywords', $seo[2]['value'] ?? null);

        JsonLdMulti::addImage(asset($course->cover_image));
        SEOTools::opengraph()->addProperty('image', asset($course->cover_image));
        SEOTools::jsonLd()->addImage(asset($course->cover_image));

        SEOTools::setCanonical($seo[4]['value'] ?? url('/'));
        $course->increment('views');
        $course->load(['subCategory:id,name', 'category:id,name', 'content', 'content.lectures', 'instructor:id,name,email,image', 'language:id,name', 'reviews.student']);
        $course->loadCount(['enroll']);
        $l = Lecture::where('course_id', $id)->get();
        $course['lectures_count'] = $l->count();
        $course['lectures_length'] = $this->sec2time($l->sum('duration') * 60);

        $discount = SpecialDiscount::where('course_id', $id)->orderBy('percentage', 'desc')->get()->filter(function ($item) {
            if (Carbon::now()->between($item->start_time, $item->end_time)) {
                return $item;
            }
        })->first();

        $course['ins_sub'] = 0;
        $course['in_cart'] = 0;
        $course['is_saved'] = 0;
        $course['is_reported'] = 0;
        $course['is_like'] = 2;
        $course['is_buy'] = 0;

        $totr = count($course->reviews);
        if ($totr > 0) {
            for ($i = 1; $i <= 5; $i++) {
                # code...
                $index = $i . '_star';
                $course[$index] = round(($course->reviews->where('star', $i)->count() * 100) / $totr);
            }
        }

        $ud = $request->user('student');
        if ($ud) {
            $s = Subscription::firstWhere([['instructor_id', $course->instructor_id], ['student_id', $ud->id]]);
            $c = Cart::firstWhere([['course_id', $course->id], ['student_id', $ud->id]]);
            $sc = SavedCourses::firstWhere([['course_id', $course->id], ['student_id', $ud->id]]);
            $r = ReportAbuse::firstWhere([['course_id', $course->id], ['student_id', $ud->id]]);
            $l = LikeDislikeCourse::firstWhere([['course_id', $course->id], ['student_id', $ud->id]]);
            $b = Order::firstWhere([['course_id', $course->id], ['student_id', $ud->id]]);

            $course['ins_sub'] = $s ? 1 : 0;
            $course['in_cart'] = $c ? 1 : 0;
            $course['is_reported'] = $r ? 1 : 0;
            $course['is_saved'] = $sc ? 1 : 0;
            $course['is_buy'] = $b ? 1 : 0;
            if ($b) {
                $course['own_rating'] = CourseRating::firstWhere([['course_id', $course->id], ['student_id', $ud->id]]);
            }
            $course['is_like'] = $l ? $l->for_what : 2;
        }

        return view('frontend.student.course.show', compact('course', 'discount'));
    }

    public function courseShare($slug, $id)
    {
        $course = Course::findOrFail($id);
        $course->increment('share');
        return view('frontend.student.course.share', compact('course'));
    }
    public function streamShare($slug, $id)
    {
        $ls = LiveStream::findOrFail($id);
        $ls->increment('share');
        $ins = Instructor::find($ls->instructor_id);
        return view('frontend.student.course.share', compact('ins'));
    }

    public function categoriesCourses($slug, $id, Request $request)
    {
        $seo = AdminSetting::whereIn('id', [28, 29, 30, 31, 32])->get();

        JsonLdMulti::setTitle('Find courses from best category on ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOTools::twitter()->setTitle('Find courses from best category on ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOMeta::setTitle('Find courses from best category on ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOTools::setTitle('Find courses from best category on ' . env('APP_NAME') ?? env('APP_NAME'));

        JsonLdMulti::setDescription($seo[1]['value'] ?? null);
        SEOMeta::setDescription($seo[1]['value'] ?? null);
        SEOTools::setDescription($seo[1]['value'] ?? null);

        SEOMeta::addKeyword($seo[2]['value'] ?? null);
        SEOTools::opengraph()->addProperty('keywords', $seo[2]['value'] ?? null);

        JsonLdMulti::addImage(asset('frontend/images/seoimage.png'));
        SEOTools::opengraph()->addProperty('image', asset('frontend/images/logo.svg'));
        SEOTools::jsonLd()->addImage(asset('frontend/images/seoimage.png'));

        SEOTools::setCanonical($seo[4]['value'] ?? url('/'));
        $cat = Category::findOrFail($id);
        $q = $request->q ?? "";
        $courses = Course::with(['instructor:id,name', 'category:id,name', 'SubCategory:id,name'])->where([['status', 1], ['category_id', $id]])->where('title', 'LIKE', '%' . $q . '%')->inRandomOrder()->paginate(12);

        $params = ['q' => $q];

        return view('frontend.student.category.index', compact('courses', 'params', 'cat'));
    }

    public function explore(Request $request)
    {
        $seo = AdminSetting::whereIn('id', [28, 29, 30, 31, 32])->get();

        JsonLdMulti::setTitle('Explore now ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOTools::twitter()->setTitle('Explore now ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOMeta::setTitle('Explore now ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOTools::setTitle('Explore now ' . env('APP_NAME') ?? env('APP_NAME'));

        JsonLdMulti::setDescription($seo[1]['value'] ?? null);
        SEOMeta::setDescription($seo[1]['value'] ?? null);
        SEOTools::setDescription($seo[1]['value'] ?? null);

        SEOMeta::addKeyword($seo[2]['value'] ?? null);
        SEOTools::opengraph()->addProperty('keywords', $seo[2]['value'] ?? null);

        JsonLdMulti::addImage(asset('frontend/images/seoimage.png'));
        SEOTools::opengraph()->addProperty('image', asset('frontend/images/logo.svg'));
        SEOTools::jsonLd()->addImage(asset('frontend/images/seoimage.png'));

        SEOTools::setCanonical($seo[4]['value'] ?? url('/'));
        $q = $request->q ?? "";
        $streams = Instructor::where([['is_live', 1], ['status', 1]])->get();

        $courses = Course::with(['instructor:id,name', 'category:id,name', 'SubCategory:id,name'])->where('status', 1)->inRandomOrder()->where('title', 'LIKE', '%' . $q . '%')->paginate(12);

        $params = ['q' => $q];

        return view('frontend.student.category.explore', compact('courses', 'params', 'streams'));
    }

    public function liveStreams()
    {
        $seo = AdminSetting::whereIn('id', [28, 29, 30, 31, 32])->get();

        JsonLdMulti::setTitle('Live Stream on ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOTools::twitter()->setTitle('Live Stream on ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOMeta::setTitle('Live Stream on ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOTools::setTitle('Live Stream on ' . env('APP_NAME') ?? env('APP_NAME'));

        JsonLdMulti::setDescription($seo[1]['value'] ?? null);
        SEOMeta::setDescription($seo[1]['value'] ?? null);
        SEOTools::setDescription($seo[1]['value'] ?? null);

        SEOMeta::addKeyword($seo[2]['value'] ?? null);
        SEOTools::opengraph()->addProperty('keywords', $seo[2]['value'] ?? null);

        JsonLdMulti::addImage(asset('frontend/images/seoimage.png'));
        SEOTools::opengraph()->addProperty('image', asset('frontend/images/logo.svg'));
        SEOTools::jsonLd()->addImage(asset('frontend/images/seoimage.png'));

        SEOTools::setCanonical($seo[4]['value'] ?? url('/'));
        $instructors = Instructor::where([['is_live', 1], ['status', 1]])->inRandomOrder()->get();
        return view('frontend.student.livestreams.index', compact('instructors'));
    }
   public function liveStreamShow($slug, $id, Request $request)
    {

        $inst = Instructor::where([['is_live', 1], ['status', 1], ['id', $id]])->first();

        if (!$inst) {
            return abort(404);
        }

        $seo = AdminSetting::whereIn('id', [28, 29, 30, 31, 32])->get();

        JsonLdMulti::setTitle($inst->name . ' is live on ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOTools::twitter()->setTitle($inst->name . ' is live on ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOMeta::setTitle($inst->name . ' is live on ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOTools::setTitle($inst->name . ' is live on ' . env('APP_NAME') ?? env('APP_NAME'));

        JsonLdMulti::setDescription($seo[1]['value'] ?? null);
        SEOMeta::setDescription($seo[1]['value'] ?? null);
        SEOTools::setDescription($seo[1]['value'] ?? null);

        SEOMeta::addKeyword($seo[2]['value'] ?? null);
        SEOTools::opengraph()->addProperty('keywords', $seo[2]['value'] ?? null);

        JsonLdMulti::addImage(asset($inst->image));
        SEOTools::opengraph()->addProperty('image', asset($inst->image));
        SEOTools::jsonLd()->addImage(asset($inst->image));

        SEOTools::setCanonical($seo[4]['value'] ?? url('/'));

        $ud = $request->user('student');
        $inst['ins_sub'] = 0;
       
        $live = LiveStream::where([['instructor_id', $id], ['status', 1]])->latest()->first();
        if(!$live || !$live->embed_code){
         $inst->is_live = 0;
         $inst->save();
         return abort(404);

        }
        if ($ud) {
            $s = Subscription::firstWhere([['instructor_id', $id], ['student_id', $ud->id]]);
            $inst['ins_sub'] = $s ? 1 : 0;
        }
        
        $live->increment('views');
        $comments = StreamComment::where('stream_id', $live->id)->get();
        $livestreams = Instructor::where([['is_live', 1], ['status', 1], ['id', '!=', $id]])->limit(15)->get();
        return view('frontend.student.livestreams.show', compact('inst', 'live', 'livestreams', 'comments'));
    }

    public function sec2time($sec)
    {
        $returnstring = " ";
        $days = intval($sec / 86400);
        $hours = intval(($sec / 3600) - ($days * 24));
        $minutes = intval(($sec - (($days * 86400) + ($hours * 3600))) / 60);
        $seconds = $sec - (($days * 86400) + ($hours * 3600) + ($minutes * 60));
        $returnstring .= ($days) ? (($days == 1) ? "1 day" : "$days days") : "";
        $returnstring .= ($days && $hours && !$minutes && !$seconds) ? " and " : " ";
        $returnstring .= ($hours) ? (($hours == 1) ? "1 hour" : "$hours hours") : "";
        $returnstring .= (($days || $hours) && ($minutes && !$seconds)) ? " and " : " ";
        $returnstring .= ($minutes) ? (($minutes == 1) ? "1 minute" : "$minutes minutes") : "";
        $returnstring .= (($days || $hours || $minutes) && $seconds) ? " and " : " ";
        $returnstring .= ($seconds) ? (($seconds == 1) ? "1 second" : "$seconds seconds") : "";
        return ($returnstring);
    }
}
