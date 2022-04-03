<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebLanguage extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name', 'short_name', 'is_rtl'
    ];

    protected $table = 'web_language';
}
