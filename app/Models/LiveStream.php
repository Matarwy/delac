<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveStream extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'instructor_id', 'views', 'embed_code',
        'likes',
        'dislikes',
        'share',
        'status',
        'enable_comment'
    ];
    function shortNumber($num)
    {
        $units = ['', 'K', 'M', 'B', 'T'];
        for ($i = 0; $num >= 1000; $i++) {
            $num /= 1000;
        }
        return round($num, 1) . $units[$i];
    }

    public function getLikesAttribute()
    {
        if (!isset($this->attributes['likes']))
            return null;

        return  array_filter(explode(",", $this->attributes['likes']));
    }
    public function setLikesAttribute($value)
    {
        $this->attributes['likes'] = implode(",", $value);
    }
    public function getDislikesAttribute()
    {
        if (!isset($this->attributes['dislikes']))
            return null;

        return  array_filter(explode(",", $this->attributes['dislikes']));
    }
    public function setDislikesAttribute($value)
    {
        $this->attributes['dislikes'] = implode(",", $value);
    }
}
