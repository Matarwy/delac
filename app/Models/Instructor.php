<?php

namespace App\Models;

use App\Notifications\CustomVerifyNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Instructor extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    protected $guard = 'instructor';
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'headline', 'description', 'website', 'facebook', 'twitter', 'linkedin', 'youtube', 'email_notification', 'push_notification', 'image', 'verify_pro', 'popular', 'status', 'is_live', 'balance', 'provider', 'provider_id'
    ];

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
    public function Notifications()
    {
        return $this->hasMany(Notification::class, 'user_id', 'id')->where('who_is', 2)->latest();
    }
    public function latestChat()
    {
        return $this->hasMany(ChatGroup::class, 'user_one', 'id');
    }
    public function Enroll()
    {
        return $this->hasMany(Order::class);
    }
    public function Courses()
    {
        return $this->hasMany(Course::class);
    }
    public function Discussions()
    {
        return $this->hasMany(InstructorDiscussion::class);
    }
    public function Subscribers()
    {
        return $this->hasMany(Subscription::class);
    }
    function shortNumber($num)
    {
        $units = ['', 'K', 'M', 'B', 'T'];
        for ($i = 0; $num >= 1000; $i++) {
            $num /= 1000;
        }
        return round($num, 1) . $units[$i];
    }

    public function sendEmailVerificationNotification()
    {
        return  $this->notify(new CustomVerifyNotification("instructor"));
    }
}
