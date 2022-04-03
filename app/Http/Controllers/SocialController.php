<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\Student;
use Illuminate\Http\Request;
use Socialite;
use Illuminate\Support\Facades\Session;

class SocialController extends Controller
{
    //
    public function redirectToProvider($user_type = 'student', $provider = 'google')
    {
        Session::forget('user_type');
        Session::put('user_type', $user_type);
        if ($provider == 'google') {
            return Socialite::driver('google')->redirect();
        } else if ($provider == 'facebook') {
            return Socialite::driver('facebook')->redirect();
        } else if ($provider == 'twitter') {
            return Socialite::driver('twitter')->redirect();
        }
        return redirect('login');
    }
    public function handleProviderCallback($provider)
    {
        if ($provider == 'google') {
            try {
                $user = Socialite::driver('google')->user();
            } catch (\Exception $e) {
                return redirect('/login')->withStatus(__('Something went wrong.'));
            }
        } else if ($provider == 'facebook') {
            try {
                $user = Socialite::driver('facebook')->user();
            } catch (\Exception $e) {
                return redirect('/login')->withStatus(__('Something went wrong.'));
            }
        } else if ($provider == 'twitter') {
            try {
                $user = Socialite::driver('twitter')->user();
            } catch (\Exception $e) {
                return redirect('/login')->withStatus(__('Something went wrong.'));
            }
        }
        $ut = Session::get("user_type") ?? 'student';
        if ($ut == 'instructor') {

            $existingUser = Instructor::where('email', $user->email)->first();
        } else {

            $existingUser = Student::where('email', $user->email)->first();
        }
        if ($existingUser) {

            if ($existingUser->provider == $provider) {
                auth($ut)->login($existingUser, true);
            } else {
                return redirect('/login')->withStatus(__('User is already exists.'));
            }
        } else {
            if ($ut == 'instructor') {
                $user = Instructor::create([
                    'email' => $user->email,
                    'name' => $user->name,
                    'provider_id' => $user->id,
                    'provider' => $provider,
                ]);
            } else {
                $user = Student::create([
                    'email' => $user->email,
                    'name' => $user->name,
                    'provider_id' => $user->id,
                    'provider' => $provider,
                ]);
            }
            $user->markEmailAsVerified();
            auth($ut)->login($user, true);
        }
        if ($ut == 'instructor') {
            return redirect()->to('/instructor/home')->withStatus(__('We Happy to see you.'));
        }else {
            return redirect()->to('/')->withStatus(__('We Happy to see you.'));
        }
    }
}
