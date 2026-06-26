<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiReport extends Model
{
    use HasFactory;

    public $timestamps = false; // تعطيل التوقيت الافتراضي لـ Laravel

    protected $table = 'ai_reports';

    protected $fillable = [
        'project_id',
        'risk_level',
        'delay_probability',
        'completion_rate',
        'time_consumed_rate',
        'generated_at'
    ];

    protected $casts = [
        'delay_probability' => 'float',
        'completion_rate' => 'float',
        'time_consumed_rate' => 'float',
        'generated_at' => 'datetime'
    ];

    // علاقة تقرير الذكاء الاصطناعي بالمشروع الذي يخصه (AiReport belongs to a Project)
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
