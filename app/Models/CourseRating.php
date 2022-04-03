<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseRating extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'course_id',
        'student_id',
        'star',
        'msg',
    ];


    public function Student()
    {
        return $this->belongsTo(Student::class);
    }
    public function Course()
    {
        return $this->belongsTo(Course::class);
    }
}
