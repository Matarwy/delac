<?php

use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FAQController;
use App\Http\Controllers\Admin\InstructorController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\LicenseController;
use App\Http\Controllers\Admin\NotiTemplateController;
use App\Http\Controllers\Admin\PayoutController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\WebLanguageController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\ChatGroupController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Instructor\AuthController;
use App\Http\Controllers\Instructor\BusinessController;
use App\Http\Controllers\Instructor\CourseContentController;
use App\Http\Controllers\Instructor\CourseController;
use App\Http\Controllers\Instructor\InsVerifyController;
use App\Http\Controllers\Instructor\LectureController;
use App\Http\Controllers\Instructor\LiveStreamController;
use App\Http\Controllers\Instructor\SpecialDiscountController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\Student\CartController;
use App\Http\Controllers\Student\CourseRatingController;
use App\Http\Controllers\Student\IndexController;
use App\Http\Controllers\Student\InstructorDiscussionController;
use App\Http\Controllers\Student\LikeDislikeCourseController;
use App\Http\Controllers\Student\ReportAbuseController;
use App\Http\Controllers\Student\SavedCoursesController;
use App\Http\Controllers\Student\SubscriptionController;
use App\Models\Instructor;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::post('saveEnvData', [LicenseController::class, 'saveEnvData']);
Route::any('installer', [LicenseController::class, 'installer']);
Route::post('saveAdminData', [LicenseController::class, 'saveAdminData']);
Route::post('activeLicence', [LicenseController::class, 'activeLicence']);
Route::get('activeLicence', [LicenseController::class, 'activeLicenceGet']);
Route::get('locale/{locale}', function ($locale) {
    \Session::put('locale', $locale);
    return redirect()->back();
})->name('locale.change');
Route::get('/home', function () {
    return redirect('admin/dashboard');
})->name('home');

Route::get('category/{id}', [CategoryController::class, 'getCategory']);
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', function () {
        return redirect('admin/dashboard');
    });

    Route::group(['middleware' => ['auth', 'web']], function () {
        Route::get('/dashboard', [AdminSettingController::class, 'dashboard']);
        Route::resources([
            'role' => RoleController::class,
            'users' => UsersController::class,
            'languages' => LanguageController::class,
            'categories' => CategoryController::class,
            'sub-categories' => SubCategoryController::class,
            'instructors' => InstructorController::class,
            'students' => StudentController::class,
            'faqs' => FAQController::class,
            'payout' => PayoutController::class,
            'noti-template' => NotiTemplateController::class,
            'web-language' => WebLanguageController::class,
        ]);
        Route::get('download/{lang?}', [WebLanguageController::class, 'downloadBaseFile'])->name('download.langFile');
        Route::group(['prefix' => 'setting'], function () {
            Route::get('legal', [AdminSettingController::class, 'legal'])->name('setting.legal');
            Route::get('general', [AdminSettingController::class, 'general'])->name('setting.general');
            Route::get('mail', [AdminSettingController::class, 'email'])->name('setting.mail');
            Route::get('push-notification', [AdminSettingController::class, 'notiset'])->name('setting.pushnoti');
            Route::get('social', [AdminSettingController::class, 'social'])->name('setting.social');
            Route::get('social-login', [AdminSettingController::class, 'sociallogin'])->name('setting.social-login');
            Route::get('seo', [AdminSettingController::class, 'seo'])->name('setting.seo');
            Route::get('appearance', [AdminSettingController::class, 'appearance'])->name('setting.appearance');
            Route::get('payment', [AdminSettingController::class, 'payment'])->name('setting.payment');
            Route::get('other', [AdminSettingController::class, 'other'])->name('setting.other');
            Route::post('update', [AdminSettingController::class, 'update'])->name('setting.update');
        });
        Route::group(['prefix' => 'report'], function () {
            Route::any('student-registration', [ReportController::class, 'studentReg'])->name('report.stureg');
            Route::any('instructor-registration', [ReportController::class, 'instructorReg'])->name('report.instructorreg');
            Route::any('subscription', [ReportController::class, 'subscription'])->name('report.subscription');
            Route::any('course-sell', [ReportController::class, 'courseSell'])->name('report.coursesell');
            Route::any('earning', [ReportController::class, 'earning'])->name('report.earning');
        });
        Route::get('verification', [InsVerifyController::class, 'index'])->name('verification.adindex');
        Route::get('feedback', [FeedbackController::class, 'index'])->name('feedback.index');
        Route::put('verification/{id}', [InsVerifyController::class, 'update'])->name('verification.update');

        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.adedit');
        Route::get('courses/{status}', [InstructorController::class, 'courseIndex']);
        Route::get('courses/{id}/show', [InstructorController::class, 'courseShow'])->name('admin-course.show');
        Route::get('review/{id}/delete', [InstructorController::class, 'reviewDelete'])->name('admin-review.delete');
        Route::post('courses/{id}/update', [InstructorController::class, 'courseUpdate'])->name('admin-course.update');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.adupdate');
        Route::put('profile/password', [ProfileController::class, 'password'])->name('profile.adpassword');
        Route::get('logout', function () {
            Auth::logout();
            return redirect('login');
        })->name('admin.logout');
    });
    Auth::routes(['verify' => true]);
    Route::get('/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('admin.showResetForm');
    Route::get('/resetemail/{user_type}', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.showResetEmailForm');
    Route::post('/reset', [ResetPasswordController::class, 'reset'])->name('admin.password.update');
});

Route::group(['prefix' => 'instructor'], function () {
    Route::get('/', function () {
        return redirect('instructor/home');
    });

    Route::get('/email/verify', function () {

        if (Auth::user()->hasVerifiedEmail()) {
            return redirect('home');
        }
        return view('auth.verify');
    })->middleware('auth:instructor')->name('insverification.notice');

    Route::post('/email/verify/resend', function () {

        Auth::user()->sendEmailVerificationNotification();

        return back()->withResent(__('A fresh verification link has been sent to your email address..'));
    })->middleware(['auth:instructor', 'web'])->name('insverification.resend');
    Route::get('email/verify/{id}/{hash}/{user_type}', [VerificationController::class, 'verify'])->name('ownverification.verify');

    Route::get('register', [AuthController::class, 'registerView']);
    Route::get('{user_type?}/auth/{provider}/redirect', [SocialController::class, 'redirectToProvider']);
    Route::get('login', [AuthController::class, 'LoginView']);
    Route::get('/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('instructor.showResetForm');
    Route::get('/resetemail/{user_type}', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('instructor.showResetEmailForm');
    Route::post('/reset', [ResetPasswordController::class, 'reset'])->name('instructor.password.update');
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::group(['middleware' => ['auth:instructor', 'verified:insverification.notice']], function () {
        Route::resources([
            'courses' => CourseController::class,
            'course-content' => CourseContentController::class,
            'special-discount' => SpecialDiscountController::class,
            'lectures' => LectureController::class,
            'live-stream' => LiveStreamController::class,
        ]);

        Route::get('messages/{id}', [ChatGroupController::class, 'show'])->name('ins-message.show');
        Route::post('messages/send', [ChatGroupController::class, 'savemsg'])->name('ins-message.send');
        Route::post('messages/ajax', [ChatGroupController::class, 'latestmsgajax'])->name('ins-message.ajax');
        Route::get('messages', [ChatGroupController::class, 'index'])->name('ins-messages');

        Route::get('home', [InsVerifyController::class, 'dashboard'])->name('ins-home');
        Route::get('analytics', [InsVerifyController::class, 'analytics'])->name('ins-analytics');
        Route::any('help', [FAQController::class, 'faqHelp']);
        Route::get('notifications', [FAQController::class, 'notification'])->name('ins-notification');

        Route::get('live-stream-end', [LiveStreamController::class, 'streamEnd'])->name('live-stream.end');
        Route::post('courses-update-media', [CourseController::class, 'updateMedia'])->name('courses.mediaUpdate');
        Route::get('courses/{id}/update-status/{status}', [CourseController::class, 'updateStatus'])->name('courses.updateStatus');
        Route::post('courses-update-full/{course}', [CourseController::class, 'fullUpdate'])->name('courses.fullUpdate');
        Route::post('courses-update-session', [CourseController::class, 'updateSession'])->name('courses.sessionUpdate');
        Route::post('course-content-store', [CourseContentController::class, 'storeOnlyContent'])->name('course-content.store-only');
        Route::get('course-content-move/{courseContent}/{moved}', [CourseContentController::class, 'upSideDown'])->name('course-content.move');
        Route::get('review', [CourseController::class, 'allReview'])->name('review.index');
        Route::get('lectures/{lecture}/{moved}', [LectureController::class, 'upSideDown'])->name('lectures.move');

        Route::get('feedback', [FeedbackController::class, 'index']);
        Route::any('earning', [BusinessController::class, 'earning']);
        Route::any('statements', [BusinessController::class, 'statements']);
        Route::get('payout', [BusinessController::class, 'payout']);
        Route::post('payout', [BusinessController::class, 'payoutStore'])->name('payout.store');

        Route::get('order-invoice/{id}', [OrderController::class, 'invoice'])->name('order.invoice-ins');

        Route::post('feedback', [FeedbackController::class, 'store']);

        Route::get('verification', [InsVerifyController::class, 'index'])->name('verification.index');

        Route::post('verification', [InsVerifyController::class, 'store'])->name('verification.store');
        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [ProfileController::class, 'updateins'])->name('profile.updateins');
        Route::put('profile/password', [ProfileController::class, 'password'])->name('profile.password');
        Route::get('logout', function () {
            Auth::logout();
            return redirect('login');
        })->name('ins.logout');
    });
});

Route::get('/', [IndexController::class, 'index']);
Route::get('legal/{slug}', [AdminSettingController::class, 'websiteIndex']);
Route::any('instructors', [IndexController::class, 'instructorAll'])->name('instructorAll');
Route::get('instructors/{slug}/{id}', [IndexController::class, 'instructorShow'])->name('instructorShow');
Route::get('live', [IndexController::class, 'liveStreams'])->name('live.index');
Route::get('live/{slug}/{id}', [IndexController::class, 'liveStreamShow'])->name('live.show');
Route::any('explore', [IndexController::class, 'explore'])->name('explore');
Route::any('courses/{type?}', [IndexController::class, 'coursesAll'])->name('coursesAll');
Route::any('categories/{slug}/{id}', [IndexController::class, 'categoriesCourses'])->name('categoriesCourses');
Route::get('courses/{slug}/{id}', [IndexController::class, 'courseShow'])->name('courseShow');
Route::get('courses/{slug}/{id}/share', [IndexController::class, 'courseShare'])->name('courseShare');

Route::get('register', [AuthController::class, 'registerView']);
Route::get('/reset/{token}/{user_type}', [ResetPasswordController::class, 'showResetForm'])->name('student.showResetForm');
Route::get('/resetemail/{user_type}', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('student.showResetEmailForm');
Route::post('/reset', [ResetPasswordController::class, 'reset'])->name('student.password.update');

Route::get('success', function (Request $request) {
    $s = $request->get('session_id');
    return redirect("order/stripe/$s");
});

Route::any('help', [FAQController::class, 'faqHelp']);
Route::any('filter', [IndexController::class, 'filter']);
Route::get('login', [AuthController::class, 'LoginView']);

Route::post('register', [AuthController::class, 'studentRegister']);
Route::post('login', [AuthController::class, 'studentLogin']);
Route::get('cart/{id}/{from?}/add', [CartController::class, 'store'])->name('addtocart');
Route::get('instructor-comment/{id}/{action}', [InstructorDiscussionController::class, 'storeLikeDislike'])->name('ins.dis.social');
Route::get('stream/{id}/{action}', [LikeDislikeCourseController::class, 'streamLikeDislike'])->name('stream.likedislike');
Route::get('streamshare/{slug}/{id}', [IndexController::class, 'streamShare'])->name('stream.share');
Route::post('stream/comment', [LikeDislikeCourseController::class, 'streamComment'])->name('stream.comment');
Route::post('stream/comment/ajax', [LikeDislikeCourseController::class, 'streamCommentajax'])->name('stream.comment.ajax');
Route::delete('instructor-comment/{id}', [InstructorDiscussionController::class, 'destroy'])->name('ins.dis.destroy');
Route::get('report/{id}/add', [ReportAbuseController::class, 'store'])->name('addtoreport');
Route::get('report', [ReportAbuseController::class, 'index']);
Route::get('cart/{id}/remove', [CartController::class, 'destroy'])->name('removefromcart');
Route::get('save/{id}/add', [SavedCoursesController::class, 'store'])->name('addtosave');
Route::get('save/{id}/remove', [SavedCoursesController::class, 'destroy'])->name('removefromsave');
Route::get('subscription/{id}/add', [SubscriptionController::class, 'store'])->name('subscribe');
Route::get('like/{id}/{what}', [LikeDislikeCourseController::class, 'store'])->name('likedislike');
Route::get('like-delete/{id}', [LikeDislikeCourseController::class, 'destroy'])->name('deletelikedislike');
Route::get('subscription/{id}/remove', [SubscriptionController::class, 'destroy'])->name('unsubscribe');
Route::get('feedback', [FeedbackController::class, 'index']);
Route::post('feedback', [FeedbackController::class, 'store']);
Route::get('{user_type?}/auth/{provider}/redirect', [SocialController::class, 'redirectToProvider']);
Route::get('auth/{provider}/callback', [SocialController::class, 'handleProviderCallback']);
Route::post('savedevicetoken', function (Request $request) {
    if (Auth::guard('student')->check()) {
        Student::findOrFail(Auth::guard('student')->id())->update(['device_token' => $request->device_token]);
        return "student-done";
    } elseif (Auth::guard('instructor')->check()) {
        Instructor::findOrFail(Auth::guard('instructor')->id())->update(['device_token' => $request->device_token]);
        return "instructor-done";
    }
    return "nologin";
});
Route::group(['middleware' => ['auth:student', 'verified:stuverification.notice']], function () {

    Route::get('messages', [ChatGroupController::class, 'index'])->name('stu-messages');

    Route::get('notifications', [FAQController::class, 'notification']);
    Route::get('messages/{id}', [ChatGroupController::class, 'show'])->name('stu-message.show');
    Route::post('messages/send', [ChatGroupController::class, 'savemsg'])->name('stu-message.send');
    Route::post('messages/ajax', [ChatGroupController::class, 'latestmsgajax'])->name('message.ajax');

    Route::get('saved-course', [SavedCoursesController::class, 'index'])->name('saved-course');

    Route::get('subscription', [SubscriptionController::class, 'index'])->name('subscription');
    Route::get('cart', [CartController::class, 'index'])->name('cart');
    Route::post('ratting', [CourseRatingController::class, 'store']);
    Route::post('instructor-comment', [InstructorDiscussionController::class, 'store']);
    Route::get('order/{payment}/{token}', [OrderController::class, 'store'])->name('order.store');
    Route::get('order', [OrderController::class, 'index'])->name('order.index');
    Route::get('order-invoice/{id}', [OrderController::class, 'invoice'])->name('order.invoice');

    Route::get('saved-course/remove', [SavedCoursesController::class, 'removeAll'])->name('saved-course-delete');

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.editstu');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.updatestu');
    Route::put('profile/password', [ProfileController::class, 'password'])->name('profile.passwordstu');

    Route::get('thank-you', function () {
        return view('frontend.student.thankyou');
    });

    Route::get('logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('stu.logout');
});
Route::get('/email/verify', function () {

    if (Auth::user()->hasVerifiedEmail()) {
        return redirect('home');
    }
    return view('auth.verify');
})->middleware('auth:student')->name('stuverification.notice');

Route::post('/email/verify/resend', function () {

    Auth::user()->sendEmailVerificationNotification();

    return back()->withResent(__('A fresh verification link has been sent to your email address..'));
})->middleware(['auth:student', 'web'])->name('stuverification.resend');
Route::get('email/verify/{id}/{hash}/{user_type}', [VerificationController::class, 'verify'])->name('ownverification.verify');
