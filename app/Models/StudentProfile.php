<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentProfile extends Model
{
    protected $fillable = [
        'user_id',
        'education_level',
        'bac_type',
        'bac_field',
        'school_name',
        'school_type',
        'preferred_school_types',
        'interested_services',
        'birth_date',
        'gender',
        'city',
        'consent_contact',
        'is_complete',
    ];

    protected $casts = [
        'preferred_school_types' => 'array',
        'interested_services' => 'array',
        'birth_date' => 'date',
        'consent_contact' => 'boolean',
        'is_complete' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
