<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Gate;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{
    //
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        if (Auth::guard('instructor')->check()) {
            return view('frontend.instructor.auth.profile');
            dd(Auth::guard('admin')->user()->name);
        } elseif (Auth::guard('web')->check()) {
            return view('admin.profile.edit');

        } else {
            return view('frontend.student.auth.profile');
        }
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        $reqData = $request->all(); 
        if ($request->hasFile('image')) {
            //
            $reqData['image'] =  (new HelperController)->uploadfile($request->image, 'upload/image');
        }
       
        auth()->user()->update($reqData);

        return back()->withStatus(__('Profile Updated Successfully.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => $request->get('password')]);

        return back()->withStatus(__('Password Updated Successfully.'));
    }
    public function updateins(Request $request)
    {
        $reqData = $request->all();
        if ($request->hasFile('image')) {
            //
            $reqData['image'] =  (new HelperController)->uploadfile($request->image, 'upload/image');
        }
        if (!$request->has('name')) {

            $reqData['email_notification'] = $request->has('email_notification') ? 1 : 0;
            $reqData['push_notification'] = $request->has('push_notification') ? 1 : 0;
        }
        auth()->user()->update($reqData);

        return back()->withStatus(__('Profile successfully updated.'));
    }
}
