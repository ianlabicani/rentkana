<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasUuids;

    protected $fillable = [
        'landlord_id',
        'title',
        'description',
        'price',
        'location',
        'status',
        'picture_urls',
    ];

    protected $casts = [
        'picture_urls' => 'array',
        'description' => 'array',
    ];

    public function landlord()
    {
        return $this->belongsTo(User::class, 'landlord_id');
    }
}

