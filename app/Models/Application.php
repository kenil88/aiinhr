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

    public function aiBadge(): array
    {
        if (!$this->overall_score) {
            return ['label' => 'No AI', 'class' => 'bg-gray-100 text-gray-600'];
        }

        if ($this->overall_score >= 80) {
            return ['label' => 'AI ' . $this->overall_score, 'class' => 'bg-green-100 text-green-700'];
        }

        if ($this->overall_score >= 60) {
            return ['label' => 'AI ' . $this->overall_score, 'class' => 'bg-yellow-100 text-yellow-700'];
        }

        return ['label' => 'AI ' . $this->overall_score, 'class' => 'bg-red-100 text-red-700'];
    }
    public function stage()
    {
        return $this->belongsTo(HiringStage::class);
    }
}
