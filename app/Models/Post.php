<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'small_description',
        'description',
        'image',
        'course_name',
        'course_type',
        'location',
        'duration',
        'course_format',
        'attendance_type',
        'institute_id',
    ];

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    /**
     * Increment the like count.
     */
    public function incrementLikes()
    {
        $this->increment('likes_count');
    }

    /**
     * Increment the views count.
     */
    public function incrementViews()
    {
        $this->increment('views_count');
    }

    public function likes()
{
    return $this->hasMany(Like::class);
}

    
}

