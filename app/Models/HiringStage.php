<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HiringStage extends Model
{
    protected $fillable = [
        'job_id',
        'name',
        'sort_order',
        'is_active',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'stage_id');
    }
}
