<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    use HasFactory;

    public $timestamps = false; // تعطيل التوقيت الافتراضي لـ Laravel

    protected $fillable = [
        'project_id',
        'name',
        'weight',
        'completion',
        'due_date',
        'is_completed',
        'created_at'
    ];

    protected $casts = [
        'due_date' => 'date',
        'is_completed' => 'boolean',
        'weight' => 'decimal:2',
        'completion' => 'decimal:2',
        'created_at' => 'datetime'
    ];

    // علاقة المرحلة بالمشروع الذي تنتمي إليه (Milestone belongs to a Project)
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
