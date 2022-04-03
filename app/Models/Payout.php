<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('latest', function (Builder $builder) {
            $builder->orderby('created_at', 'desc');
        });
    }
    protected $fillable = [
        'instructor_id', 'amount', 'status', 'remark',
    ];
    public function Instructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id', 'id');
    }
}
