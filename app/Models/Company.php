<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'description',
        'country',
        'city',
        'address',
        'phone',
        'email',
        'website',
        'facebook',
        'twitter',
        'linkedin',
        'is_active',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
}
