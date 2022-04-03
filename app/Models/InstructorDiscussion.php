<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructorDiscussion extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'instructor_id',
        'student_id',
        'comment',
        'likes',
        'dislikes',
    ];
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('latest', function (Builder $builder) {
            $builder->orderby('created_at', 'desc');
        });
    }
    protected $with = ['student'];
    public function Student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
    public function Instructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id', 'id');
    }
    public function getLikesAttribute()
    {
        if (!isset($this->attributes['likes']))
            return [];

        return  array_filter(explode(",", $this->attributes['likes']));
    }
    public function setLikesAttribute($value)
    {
        $this->attributes['likes'] =   implode(",", $value);
    }
    public function setDislikesAttribute($value)
    {
        $this->attributes['dislikes'] =  implode(",", $value);
    }
    public function getDislikesAttribute()
    {
        if (!isset($this->attributes['dislikes']))
            return [];

        return  array_filter(explode(",", $this->attributes['dislikes']));
    }
}
