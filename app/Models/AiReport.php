<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiReport extends Model
{
    use HasFactory;

    // اسم الجدول
    protected $table = 'ai_reports';

    // تعطيل updated_at لأن الجدول يحتوي فقط على generated_at
    public $timestamps = false;

    // الحقول المسموح بتعبئتها
    protected $fillable = [
        'project_id',
        'risk_level',
        'delay_probability',
        'completion_rate',
        'time_consumed_rate',
        'generated_at',
    ];

    // تحويل أنواع البيانات تلقائياً
    protected $casts = [
        'delay_probability' => 'float',
        'completion_rate' => 'float',
        'time_consumed_rate' => 'float',
        'generated_at' => 'datetime',
    ];

    // علاقة التقرير بالمشروع
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}