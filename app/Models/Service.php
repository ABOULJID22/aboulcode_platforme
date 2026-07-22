<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $casts = [
        'features' => 'array'
    ];

    protected $fillable = ['title','slug','description','icon','features','image'];
}
