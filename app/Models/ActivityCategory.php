<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityCategory extends Model
{
    protected $fillable = ['name', 'slug', 'status', 'sort_order'];

    protected $casts = [
        'status' => 'boolean',
    ];
}
