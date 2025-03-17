<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    use HasFactory;

    protected $fillable = [
        'institute_name', // Correct column name
        'location',
        'gov_register_number',
        'email',
        'website',
        'contact_number',
        'profile_photo', // Match the column name in your table
        'cover_photo',
        'bio',
        'password',
        'user_id',
    ];

    public function posts()
{
    return $this->hasMany(Post::class);
}
    public function events()
{
    return $this->hasMany(Event::class);
}

    public function gallery()
{
    return $this->hasMany(InstituteGallery::class);
}

public function scopeApproved($query)
{
    return $query->where('status', 'approved');
}
public function chats()
{
    return $this->hasMany(Chat::class, 'user2_id');
}
public function user()
    {
        return $this->belongsTo(User::class);
    }


}