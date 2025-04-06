<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class VerifiedLandlord extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'status',
        'verified_by',
        'verified_at',
        'remarks'
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
