<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'activity_id', 'company_id', 'status', 'execution_date', 'start_time', 'end_time', 'budget', 'admin_notes',
        'coordinator_name', 'coordinator_phone', 'report_path', 'photos'
    ];

    protected $casts = [
        'photos' => 'array',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
