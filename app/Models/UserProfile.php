<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function password()
    {
        return $this->hasOne(Password::class);
    }
}
