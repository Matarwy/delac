<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'student_id', 'instructor_id', 'course_id', 'price', 'payment_method', 'payment_token', 'admin_commission', 'status', 'uid'
    ];
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('latest', function (Builder $builder) {
            $builder->orderby('created_at', 'desc');
        });
    }
    public function Student()
    {
        return $this->belongsTo(Student::class);
    }
    public function Instructor()
    {
        return $this->belongsTo(Instructor::class);
    }
    public function Course()
    {
        return $this->belongsTo(Course::class);
    }
}
