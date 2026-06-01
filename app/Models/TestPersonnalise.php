<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestPersonnalise extends Model
{
    protected $fillable = [
        'user_id',
        'test_name',
        'version',
        'target_level',
        'status',
        'answers',
        'axis_scores',
        'domain_scores',
        'result_payload',
        'primary_domain',
        'secondary_domain',
        'result_summary',
        'submitted_at',
    ];

    protected $casts = [
        'answers' => 'array',
        'axis_scores' => 'array',
        'domain_scores' => 'array',
        'result_payload' => 'array',
        'submitted_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }
}