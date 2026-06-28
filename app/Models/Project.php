<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // تعطيل التوقيت الافتراضي لأن الجدول يستخدم created_at فقط
    public $timestamps = false;

    // الحقول المسموح بتعبئتها
    protected $fillable = [
        'title',
        'description',
        'keywords',
        'status',
        'team_id',
        'supervisor_id',
        'expected_end_date',
        'actual_end_date',
        'progress',
        'created_at',
    ];

    // تحويل أنواع البيانات تلقائياً
    protected $casts = [
        'expected_end_date' => 'date',
        'actual_end_date'   => 'date',
        'progress'          => 'decimal:2',
        'created_at'        => 'datetime',
    ];

    // علاقة المشروع بالفريق
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    // علاقة المشروع بالمشرف
    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    // مراحل المشروع
    public function milestones()
    {
        return $this->hasMany(Milestone::class, 'project_id');
    }

    // مهام المشروع
    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id');
    }

    // ملفات المشروع
    public function files()
    {
        return $this->hasMany(File::class, 'project_id');
    }

    // تعليقات المشروع
    public function comments()
    {
        return $this->hasMany(Comment::class, 'project_id');
    }

    // تقارير الذكاء الاصطناعي
    public function aiReports()
    {
        return $this->hasMany(AiReport::class, 'project_id');
    }

    /**
     * إعادة حساب نسبة إنجاز المشروع تلقائياً
     */
    public function recalculateProgress()
    {
        $totalTasks = $this->tasks()->count();

        if ($totalTasks === 0) {
            $this->progress = 0;
        } else {
            $doneTasks = $this->tasks()
                ->where('status', 'DONE')
                ->count();

            $this->progress = round(($doneTasks / $totalTasks) * 100, 2);
        }

        $this->save();
    }
}