<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public function user()
    {
        return $this->belongsTo(UserProfile::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
