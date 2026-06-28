<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    use HasFactory;

    // تعطيل التوقيت الافتراضي لأن الجدول يستخدم created_at فقط
    public $timestamps = false;

    // الحقول المسموح بتعبئتها
    protected $fillable = [
        'project_id',
        'name',
        'weight',
        'completion',
        'due_date',
        'is_completed',
        'created_at',
    ];

    // تحويل أنواع البيانات تلقائياً
    protected $casts = [
        'due_date'      => 'date',
        'is_completed'  => 'boolean',
        'weight'        => 'decimal:2',
        'completion'    => 'decimal:2',
        'created_at'    => 'datetime',
    ];

    // علاقة المرحلة بالمشروع
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}