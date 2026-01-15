<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    use HasFactory;

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'requisition_code',
        'job_title',
        'department_id',
        'company_id',
        'requested_by',
        'approved_by',
        'openings',
        'employment_type',
        'salary_min',
        'salary_max',
        'priority',
        'status',
        'reason',
        'approved_at',
        'closed_at',
    ];

    /**
     * Casts
     */
    protected $casts = [
        'approved_at' => 'datetime',
        'closed_at' => 'datetime',
    ];

    /* =====================
     | Relationships
     ===================== */

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function job()
    {
        return $this->hasOne(Job::class);
    }

    /* =====================
     | Query Scopes
     ===================== */

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'submitted');
    }

    public function scopeCompany($query, $companyId)
    {
        return $query->where('company_id', $companyId);
    }

    /* =====================
     | Business Logic
     ===================== */

    public function canBeApproved(): bool
    {
        return in_array($this->status, ['submitted']);
    }

    public function approve(User $user): void
    {
        $this->update([
            'status'      => 'approved',
            'approved_by' => $user->id,
            'approved_at' => now(),
        ]);
    }

    public function reject(User $user): void
    {
        $this->update([
            'status'      => 'rejected',
            'approved_by' => $user->id,
        ]);
    }

    public function close(): void
    {
        $this->update([
            'status'    => 'closed',
            'closed_at' => now(),
        ]);
    }
}
