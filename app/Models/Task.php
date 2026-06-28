<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // تعطيل التوقيت الافتراضي لأن الجدول يستخدم created_at فقط
    public $timestamps = false;

    // الحقول المسموح بتعبئتها
    protected $fillable = [
        'parent_id',
        'title',
        'description',
        'status',
        'deadline',
        'project_id',
        'assigned_to',
        'created_by',
        'created_at',
    ];

    // تحويل أنواع البيانات تلقائياً
    protected $casts = [
        'deadline'   => 'date',
        'created_at' => 'datetime',
    ];

    // تحديث نسبة تقدم المشروع تلقائياً عند إضافة أو تعديل أو حذف مهمة
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

    // علاقة المهمة بالمشروع
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    // علاقة المهمة بالطالب المكلف بها
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // نفس علاقة assignee لكن باسم آخر لاستخدامها في بعض الصفحات
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // علاقة المهمة بمن أنشأها
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // علاقة المهمة بالمهمة الرئيسية
    public function parent()
    {
        return $this->belongsTo(Task::class, 'parent_id');
    }

    // المهام الفرعية التابعة لهذه المهمة
    public function subtasks()
    {
        return $this->hasMany(Task::class, 'parent_id');
    }

    // نفس علاقة subtasks لكن باسم آخر للتوافق مع أي كود سابق
    public function subTasks()
    {
        return $this->hasMany(Task::class, 'parent_id');
    }

    // تعليقات المهمة
    public function comments()
    {
        return $this->hasMany(Comment::class, 'task_id');
    }
}