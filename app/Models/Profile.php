<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'phone',
        'bio',
        'profile_image',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

