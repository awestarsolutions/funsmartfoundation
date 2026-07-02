<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'name', 'activity_category_id', 'slug', 'cover_image', 'gallery',
        'short_description', 'detailed_description', 'objectives', 'expected_impact',
        'duration', 'location', 'beneficiary_information', 'sdg_goals',
        'meta_title', 'meta_description', 'internal_notes', 'status',
        'attachments', 'pdf_brochure'
    ];

    protected $casts = [
        'gallery' => 'array',
        'sdg_goals' => 'array',
        'attachments' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(ActivityCategory::class, 'activity_category_id');
    }
}
