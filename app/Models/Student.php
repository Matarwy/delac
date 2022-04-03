<?php

namespace App\Models;

use App\Notifications\customResetPassword;
use App\Notifications\CustomVerifyNotification;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Student extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    protected $guard = 'student';
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_notification', 'push_notification', 'image', 'status', 'provider', 'provider_id', 'device_token'
    ];
    public function Cart()
    {
        return $this->hasMany(Cart::class, 'student_id', 'id')->latest();
    }
    public function Notifications()
    {
        return $this->hasMany(Notification::class, 'user_id', 'id')->where('who_is', 1)->latest();
    }
    public function latestChat()
    {
        return $this->hasMany(ChatGroup::class, 'user_two', 'id');
    }
    public function Enroll()
    {
        return $this->hasMany(Order::class, 'student_id', 'id')->latest();
    }
    public function Subscriptions()
    {
        return $this->hasMany(Subscription::class, 'student_id', 'id')->latest();
    }
    public function subins($id)
    {
        $ins = Subscription::where('student_id', $id)->get()->pluck('instructor_id');
        return  Instructor::whereIn('id', $ins)->where('status', 1)->limit(5)->get();
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function setPasswordAttribute($value)
    {
        if (strlen($value) != 60) {

            $this->attributes['password'] = Hash::make($value);
        } else {
            $this->attributes['password'] = $value;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        return  $this->notify(new customResetPassword($token));
    }
    public function sendEmailVerificationNotification()
    {
        return  $this->notify(new CustomVerifyNotification("student"));
    }
}
