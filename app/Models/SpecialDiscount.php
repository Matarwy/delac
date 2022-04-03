<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialDiscount extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at',
        'start_time',
        'end_time'
    ];
    protected $fillable = [
        'instructor_id',
        'title',
        'percentage',
        'start_time',
        'end_time', 'course_id'
    ];
    public function Course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
    public function status($enddate, $startdate)
    {
        $now = Carbon::now();
        if ($startdate->greaterThan($now)) {

            $diff = $startdate->diffInDays($now);
            return __('Active after ') . $diff . __(' days');
        }
        $diff = $enddate->diffInDays($now);
        if ($diff > 0) {
            return __('Expired in  ') . $diff . __(' days');
        } else {

            return __('Expired ') . $diff . __(' days ago');
        }
    }
}
