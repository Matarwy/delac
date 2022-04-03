<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseContent extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'course_id',
        'position',
        'title'
    ];
    protected $table = "course_content";
    
    public function Lectures()
    {
        return $this->hasMany(Lecture::class, 'content_id','id');
    }
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('posasc', function (Builder $builder) {
            $builder->orderby('position', 'asc');
        });
    }

    public function lecturesLength($id, $format = '%02d:%02d')
    {
      $time =   Lecture::where('content_id',$id)->get()->sum('duration');
        if ($time < 1) {
            return;
        }
        $hours = floor($time / 60);
        $hours = $hours < 10 ? '0' . $hours : $hours;
        $minutes = ($time % 60);
        $minutes = $minutes < 10 ? '0' . $minutes : $minutes;
        return sprintf($format, $hours, $minutes);
    }

}
