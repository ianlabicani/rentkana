<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'type',
        'message',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
