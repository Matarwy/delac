<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportAbuse extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'student_id',
        'course_id',
    ];
    public function Course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
