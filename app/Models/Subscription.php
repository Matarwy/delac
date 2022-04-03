<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'student_id',
        'instructor_id',
    ];
    public function Student()
    {
        return $this->belongsTo(Student::class);
    }
    public function Instructor()
    {
        return $this->belongsTo(Instructor::class);
    }
}
