<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public $timestamps = false; // تعطيل التوقيت الافتراضي لـ Laravel

    protected $fillable = [
        'title',
        'description',
        'status',
        'team_id',
        'supervisor_id',
        'expected_end_date',
        'actual_end_date',
        'progress',
        'created_at'
    ];

    protected $casts = [
        'expected_end_date' => 'date',
        'actual_end_date' => 'date',
        'progress' => 'decimal:2',
        'created_at' => 'datetime'
    ];

    // علاقة المشروع بالفريق المالك له (Project belongs to a Team)
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    // علاقة المشروع بالمشرف المسؤول عنه (Project belongs to a Supervisor)
    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    // علاقة المشروع بمراحله (Project has many Milestones)
    public function milestones()
    {
        return $this->hasMany(Milestone::class, 'project_id');
    }

    // علاقة المشروع بمهامه (Project has many Tasks)
    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id');
    }

    // علاقة المشروع بملفاته المرفوعة (Project has many Files)
    public function files()
    {
        return $this->hasMany(File::class, 'project_id');
    }

    // علاقة المشروع بالتعليقات (Project has many Comments)
    public function comments()
    {
        return $this->hasMany(Comment::class, 'project_id');
    }

    // علاقة المشروع بتقارير الذكاء الاصطناعي (Project has many AiReports)
    public function aiReports()
    {
        return $this->hasMany(AiReport::class, 'project_id');
    }

    /**
     * إعادة حساب نسبة إنجاز المشروع بناءً على المهام المكتملة تلقائياً
     */
    public function recalculateProgress()
    {
        $totalTasks = $this->tasks()->count();
        if ($totalTasks === 0) {
            $this->progress = 0.00;
        } else {
            $doneTasks = $this->tasks()->where('status', 'DONE')->count();
            $this->progress = round(($doneTasks / $totalTasks) * 100, 2);
        }
        $this->save();
    }
}
