<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationStageHistory extends Model
{
    protected $fillable = [
        'application_id',
        'from_stage_id',
        'to_stage_id',
        'moved_by',
    ];

    public function fromStage()
    {
        return $this->belongsTo(HiringStage::class, 'from_stage_id');
    }

    public function toStage()
    {
        return $this->belongsTo(HiringStage::class, 'to_stage_id');
    }

    public function movedBy()
    {
        return $this->belongsTo(User::class, 'moved_by');
    }
}
