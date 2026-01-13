<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateActivity extends Model
{
    protected $fillable = [
        'company_id',
        'candidate_id',
        'application_id',
        'job_id',
        'type',
        'message',
    ];
}
