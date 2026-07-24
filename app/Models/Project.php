<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $casts = [
        'technologies' => 'array',
    ];

    protected $fillable = [
        'category_id','title','slug','excerpt','description','technologies','client','year','link','cover'
    ];

    public function category()
    {
        return $this->belongsTo(ProjectCategory::class,'category_id');
    }
}
