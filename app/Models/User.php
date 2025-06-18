<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user')
            ->using(RoleUser::class);
    }

    /**
     * Check if the user has a specific role.
     */
    public function hasRole($roleName)
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

    public function rooms()
    {
        return $this->hasMany(Room::class, 'landlord_id');
    }

    public function verification()
    {
        return $this->hasOne(VerifiedLandlord::class);
    }

    public function isVerifiedLandlord()
    {
        return $this->verification && $this->verification->status === 'approved';
    }

    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    public function isLandlord()
    {
        return $this->hasRole('landlord');
    }

    public function isRenter()
    {
        return $this->hasRole('renter');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function defaultLocations()
    {
        return $this->hasMany(DefaultLocation::class);
    }

}
