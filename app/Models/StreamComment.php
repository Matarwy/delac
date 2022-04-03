<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StreamComment extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'stream_id',
        'student_id',
        'msg',
    ];
 
    protected $with = ['student'];
    protected $table = "stream_comment";
    public function Student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
