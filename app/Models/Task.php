<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public $timestamps = false; // تعطيل التوقيت الافتراضي لـ Laravel

    protected static function booted()
    {
        static::saved(function ($task) {
            if ($task->project) {
                $task->project->recalculateProgress();
            }
        });

        static::deleted(function ($task) {
            if ($task->project) {
                $task->project->recalculateProgress();
            }
        });
    }

    protected $fillable = [
        'parent_id',
        'title',
        'description',
        'status',
        'deadline',
        'project_id',
        'assigned_to',
        'created_by',
        'created_at'
    ];

    protected $casts = [
        'deadline' => 'date',
        'created_at' => 'datetime'
    ];

    // علاقة المهمة بالمشروع الذي تنتمي إليه (Task belongs to a Project)
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    // علاقة المهمة بالطالب المكلف بها (Task assigned to a User)
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // علاقة المهمة بمنشئها (Task was created by a User)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // علاقة المهمة بمهمتها الرئيسية (Task belongs to a Parent Task)
    public function parent()
    {
        return $this->belongsTo(Task::class, 'parent_id');
    }

    // علاقة المهمة بمهامها الفرعية (Task has many Sub-Tasks)
    public function subTasks()
    {
        return $this->hasMany(Task::class, 'parent_id');
    }

    // علاقة المهمة بتعليقاتها (Task has many Comments)
    public function comments()
    {
        return $this->hasMany(Comment::class, 'task_id');
    }
}
