<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminSetting;
use App\Models\Category;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Language;
use App\Models\Order;
use App\Models\Student;
use App\Models\SubCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Gate;
use LicenseBoxAPI;
use Symfony\Component\HttpFoundation\Response;

class AdminSettingController extends Controller
{


    public function websiteIndex($slug)
    {
        if ($slug == 'privacy-policy') {
            $data = AdminSetting::find(2)->value;
            $title = __('Privacy Policy');
        } elseif ($slug == 'terms-conditions') {
            $data = AdminSetting::find(3)->value;
            $title = __('Terms & Conditions');
        } elseif ($slug == 'copyright-policy') {
            $data = AdminSetting::find(1)->value;
            $title = __('Copyright Policy');
        } else {

            return abort(404);
        }
        return view('frontend.student.legal', compact('data', 'title'));
    }

    public function apiIndex()
    {
        $as = AdminSetting::whereNotIn('id', [4, 5, 6, 16, 17])->get();
        return response()->json(['msg' => null, 'data' => $as, 'success' => true], 200);
    }
    public function apiIndexLegal()
    {
        $as = AdminSetting::whereIn('id', [16, 17])->get();
        return response()->json(['msg' => null, 'data' => $as, 'success' => true], 200);
    }
    public function general()
    {
        abort_if(Gate::denies('setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data =  AdminSetting::all();
        return view('admin.settings.general', compact('data'));
    }
    public function appearance()
    {
        abort_if(Gate::denies('setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data =  AdminSetting::all();
        return view('admin.settings.appearance', compact('data'));
    }
    public function other()
    {
        abort_if(Gate::denies('setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data =  AdminSetting::all();
        return view('admin.settings.other', compact('data'));
    }
    public function seo()
    {
        abort_if(Gate::denies('setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data =  AdminSetting::all();
        return view('admin.settings.seo', compact('data'));
    }
    public function email()
    {
        abort_if(Gate::denies('setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data =  AdminSetting::all();
        return view('admin.settings.mail', compact('data'));
    }
    public function legal()
    {
        abort_if(Gate::denies('setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data =  AdminSetting::all();
        return view('admin.settings.legal', compact('data'));
    }
    public function social()
    {
        abort_if(Gate::denies('setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data =  AdminSetting::all();
        return view('admin.settings.social', compact('data'));
    }
    public function sociallogin()
    {
        abort_if(Gate::denies('setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data =  AdminSetting::all();
        return view('admin.settings.sociallogin', compact('data'));
    }
    public function matching()
    {
        abort_if(Gate::denies('setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data =  AdminSetting::all();
        return view('admin.settings.matching', compact('data'));
    }
    public function payment()
    {
        abort_if(Gate::denies('setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data =  AdminSetting::all();
        return view('admin.settings.payment', compact('data'));
    }
    public function notiset()
    {
        abort_if(Gate::denies('setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data =  AdminSetting::all();
        return view('admin.settings.push-noti', compact('data'));
    }
    public function sms()
    {
        abort_if(Gate::denies('setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data =  AdminSetting::all();
        return view('admin.settings.sms', compact('data'));
    }
    public function update(Request $request)
    {
        $d = "email";
        $data =  AdminSetting::all();
        foreach ($data as $value) {
            $d = $value['key_name'];
            if (isset($request->$d)) {
                $value['value'] = $request->$d;
                if ($d == "seo_meta") {
                    $value['value'] = implode(",", $request->$d);
                }
                $value->save();
            }
        }
        if ($request->has('logo') && $request->hasFile('logo')) {
            $this->saveImage($request->file('logo'), 'logo.svg', "/frontend/images/");
        }
        if ($request->has('favicon') && $request->hasFile('favicon')) {
            $this->saveImage($request->file('favicon'), 'fav.png', "/frontend/images/");
        }
        if ($request->has('dark_logo') && $request->hasFile('dark_logo')) {
            $this->saveImage($request->file('dark_logo'), "ct_logo.svg", '/frontend/images/');
        }
        if ($request->has('seo_image') && $request->hasFile('seo_image')) {
            $this->saveImage($request->file('seo_image'), "seoimage.png", '/frontend/images/');
        }
        if ($request->has('footer_logo') && $request->hasFile('footer_logo')) {
            $this->saveImage($request->file('footer_logo'), 'logo1.svg', "/frontend/images/");
        }

        $env = [
            'APP_NAME',
            'MAIL_MAILER',
            'MAIL_HOST',
            'MAIL_PORT',
            'MAIL_USERNAME',
            'MAIL_PASSWORD',
            'MAIL_ENCRYPTION',
            'MAILGUN_DOMAIN',
            'MAILGUN_SECRET',
            'MAILGUN_ENDPOINT',
            'MAIL_FROM_ADDRESS',
            'GOOGLE_CLIENT_ID',
            'GOOGLE_CLIENT_SECRET',
            'GOOGLE_LOGIN',
            'FB_CLIENT_ID',
            'FB_CLIENT_SECRET',
            'FB_LOGIN',
            'TWITTER_CLIENT_ID',
            'TWITTER_CLIENT_SECRET',
            'TWITTER_REDIRECT',
            'APP_ID',
            'REST_API_KEY',
            'USER_AUTH_KEY',

        ];



        $datae = [
            'APP_NAME' => $request->name,
            'MAIL_MAILER' => env("MAIL_MAILER"),
            'MAIL_HOST' => env("MAIL_HOST"),
            'MAIL_PORT' => env("MAIL_PORT"),
            'MAIL_USERNAME' => env("MAIL_USERNAME"),
            'MAIL_PASSWORD' => env("MAIL_PASSWORD"),
            'MAIL_ENCRYPTION' => env("MAIL_ENCRYPTION"),
            'MAIL_FROM_ADDRESS' => env("MAIL_FROM_ADDRESS"),
            'MAILGUN_DOMAIN' => env("MAILGUN_DOMAIN"),
            'MAILGUN_SECRET' => env("MAILGUN_SECRET"),
            'MAILGUN_ENDPOINT' => env("MAILGUN_ENDPOINT"),
            'GOOGLE_CLIENT_ID' => env("GOOGLE_CLIENT_ID"),
            'GOOGLE_CLIENT_SECRET' => env("GOOGLE_CLIENT_SECRET"),
            'GOOGLE_LOGIN' => env("GOOGLE_LOGIN"),
            'FB_CLIENT_ID' => env("FB_CLIENT_ID"),
            'FB_CLIENT_SECRET' => env("FB_CLIENT_SECRET"),
            'FB_LOGIN' => env("FB_LOGIN"),
            'TWITTER_CLIENT_ID' => env("TWITTER_CLIENT_ID"),
            'TWITTER_CLIENT_SECRET' => env("TWITTER_CLIENT_SECRET"),
            'TWITTER_REDIRECT' => env("TWITTER_REDIRECT"),
            'APP_ID' => env("APP_ID"),
            'REST_API_KEY' => env("REST_API_KEY"),
            'USER_AUTH_KEY' => env("USER_AUTH_KEY"),

        ];

        foreach ($env as $value) {
            $d = $value;
            if (isset($request->$d)) {
                $temp = array();
                $datae[$value] = $request->$d;
            }
        }
        $this->updateENV($datae);
        return back()->withStatus(__('Setting is updated successfully.'));
    }

    public function updateENV($data)
    {
        $envFile = app()->environmentFilePath();

        if (is_writeable("../.env")) {

            $env = file_get_contents('../.env');

            $env = preg_split('/\s+/', $env);

            $delim = '';
            foreach ((array) $data as $key => $value) {

                $path = base_path('.env');
                $oldValue = env($key);
                if ($oldValue === $value) {
                }
                $value = Str::replaceArray(' ', [''], $value);
                if (file_exists($path)) {

                    file_put_contents(
                        $path,
                        str_replace(
                            $key . '=' . $delim . $oldValue . $delim,
                            $key . '=' . $delim . $value . $delim,
                            file_get_contents($path)
                        )
                    );
                }
            }

            \Artisan::call('config:clear');
            \Artisan::call('cache:clear');
            return true;
        } else {

            return abort(500, 'Don`t have write permission');
        }
    }
    public function saveImage($file, $name, $path)
    {
        $image = $file;
        $input['imagename'] = $name;
        $destinationPath = public_path("") . $path;
        $image->move($destinationPath, $input['imagename']);

        return $input['imagename'];
    }

    public function dashboard()
    {
        $api = new LicenseBoxAPI();
        $res = $api->verify_license();

        // if ($res['status'] !== true) {
        //     AdminSetting::find(42)->update(['value' => 0]);
        //     return redirect('activeLicence');
        // } else {
        //     AdminSetting::find(42)->update(['value' => 1]);
        // }
        $master['tot_admin'] = User::count();
        $master['tot_ins'] = Instructor::count();
        $master['tot_stu'] = Student::count();
        $master['lang'] = Language::count();
        $master['cat'] = Category::count();
        $master['sub_cat'] = SubCategory::count();
        $course = Course::all();
        $master['tot_course'] = $course->count();
        $master['waiting'] = $course->where('status', 2)->count();
        $master['rejected'] = $course->where('status', 4)->count();
        $master['block'] = $course->where('status', 3)->count();

        $today = Carbon::today()->subMonths(11);
        $months = [];
        $y_earning  = [];
        $y_commission  = [];
        for ($i = 0; $i < 12; $i++) {
            $o = Order::whereMonth('created_at', $today->format('m'))->whereYear('created_at', $today->format('Y'))->select("created_at")
                ->selectRaw('count(*) as total,FORMAT(SUM(price) -  SUM(admin_commission) ,2) as earning,FORMAT(SUM(admin_commission) ,2) as ac')->first();

            $months[] = $today->format('M');
            $y_earning[] = $o->earning ?? 0;
            $y_commission[] = $o->ac ?? 0;
            $today->addMonth();
        }


        $master['months'] = $months;
        $master['earning'] = $y_earning;
        $master['commission'] = $y_commission;


        $toppro = Order::with('course:id,title,cover_image')->select('course_id')->selectRaw('count(*) as total,FORMAT(SUM(price) -  SUM(admin_commission) ,2) as earning,FORMAT(SUM(admin_commission) ,2) as ac')->groupBy('course_id')->orderBy('total', 'desc')->limit(5)->get();
        $master['toppro'] = $toppro;
        $topins = Order::with('instructor:id,name,image')->select('instructor_id')->selectRaw('count(*) as total,FORMAT(SUM(price) -  SUM(admin_commission) ,2) as earning,FORMAT(SUM(admin_commission) ,2) as ac')->groupBy('instructor_id')->orderBy('total', 'desc')->limit(5)->get();
        $master['topins'] = $topins;
        return view('admin.dashboard', compact('master'));
    }
}
