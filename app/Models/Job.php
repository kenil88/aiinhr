<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'ats_jobs';

    protected $fillable = [
        'company_id',
        'title',
        'description',
        'visibility',
        'department',
        'location',
        'employment_type',
        'experience_level',
        'salary_min',
        'salary_max',
        'requisition_id',
        'status',
        'created_by',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
    public function stages()
    {
        return $this->hasMany(HiringStage::class)->orderBy('sort_order');
    }
    public function requisition()
    {
        return $this->belongsTo(Requisition::class);
    }
}
