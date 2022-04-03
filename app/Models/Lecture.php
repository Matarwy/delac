<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'description', 'content_id', 'title', 'file', 'volume', 'duration', 'position', 'course_id'
    ];
    protected $appends = ['file_type'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('posasc', function (Builder $builder) {
            $builder->orderby('position', 'asc');
        });
    }

    public function getFileTypeAttribute()
    {
        if (isset($this->attributes['file'])) {

            $file = $this->attributes['file'];
            $extension = substr($file, strpos($file, ".") + 1);
            $audio_extensions = array('jpg', 'png', 'jpeg', 'bmp');
            $video_extensions = array('mkv', 'flv', 'ogg', 'avi', 'mov', 'wmv', 'mp4', '3gp', 'm4v');

            if (in_array($extension, $audio_extensions)) {
                return 0;
            } elseif (in_array($extension, $video_extensions)) {
                return 1;
            } else {
                return 2;
            }
        } else {
            return 2;
        }
    }
    public function hoursandmins($time, $format = '%02d:%02d')
    {
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
