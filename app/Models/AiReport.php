<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiReport extends Model
{
    protected $fillable = [
        'project_id',
        'risk_level',
        'delay_probability',
        'completion_rate',
        'time_consumed_rate',
        'generated_at',
    ];

    public $timestamps = false;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}