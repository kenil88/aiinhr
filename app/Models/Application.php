<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'company_id',
        'job_id',
        'candidate_id',
        'resume_path',
        'status',
        'overall_score',
        'ai_result',
    ];

    protected $casts = [
        'ai_result' => 'array',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
