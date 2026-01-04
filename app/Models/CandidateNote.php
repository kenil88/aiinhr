<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateNote extends Model
{
    protected $fillable = [
        'candidate_id',
        'company_id',
        'user_id',
        'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault(['name' => 'System']);
    }
}
