<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CandidateActivity;
use Illuminate\Support\Facades\Auth;

class Candidate extends Model
{
    protected $fillable = [
        'company_id',
        'name',
        'email',
        'phone',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    protected static function booted()
    {
        static::created(function ($candidate) {

            CandidateActivity::create([
                'company_id' => $candidate->company_id,
                'candidate_id' => $candidate->id,
                'type' => 'candidate_added',
                'message' => 'Candidate added to talent pool',
            ]);
        });
    }

    public function notes()
    {
        return $this->hasMany(CandidateNote::class)->latest();
    }
}
