<?php

namespace App\Models;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
use Illuminate\Database\Eloquent\Model;

class AiReport extends Model
{
<<<<<<< HEAD
=======
    use HasFactory;

    public $timestamps = false; // تعطيل التوقيت الافتراضي لـ Laravel

    protected $table = 'ai_reports';

>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
    protected $fillable = [
        'project_id',
        'risk_level',
        'delay_probability',
        'completion_rate',
        'time_consumed_rate',
<<<<<<< HEAD
        'generated_at',
    ];

    public $timestamps = false;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
=======
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
>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
