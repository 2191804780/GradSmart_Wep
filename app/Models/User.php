<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // تعطيل التوقيت الافتراضي لأن الجدول لا يحتوي على updated_at
    public $timestamps = false;

    // الحقول المسموح بتعبئتها
    protected $fillable = [
        'student_id',
        'name',
        'email',
        'password',
        'role_id',
        'profile_image',
        'is_active',
        'department_id',
        'is_department_head',
        'created_at',
    ];

    // الحقول التي يتم إخفاؤها عند عرض بيانات المستخدم
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // تحويل بعض الحقول تلقائياً عند التعامل معها
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'is_active' => 'boolean',
            'created_at' => 'datetime',
        ];
    }

    // علاقة المستخدم بالدور
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    // علاقة الطالب بالفرق عبر جدول team_members
    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(
            Team::class,
            'team_members',
            'user_id',
            'team_id'
        )->withPivot('is_leader', 'joined_at');
    }

    // الفرق التي أنشأها المستخدم
    public function createdTeams()
    {
        return $this->hasMany(Team::class, 'created_by');
    }

    // الفرق التي يشرف عليها المستخدم
    public function supervisedTeams()
    {
        return $this->hasMany(Team::class, 'supervisor_id');
    }

    // المشاريع التي يشرف عليها المستخدم
    public function supervisedProjects()
    {
        return $this->hasMany(Project::class, 'supervisor_id');
    }

    // القسم التابع له المستخدم
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // طلبات الإشراف المرتبطة بالمشرف
    public function supervisorRequests()
    {
        return $this->hasMany(SupervisorRequest::class, 'supervisor_id');
    }

    // المهام المسندة للمستخدم
    public function assignedTasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    // المهام التي أنشأها المستخدم
    public function createdTasks()
    {
        return $this->hasMany(Task::class, 'created_by');
    }

    // الملفات التي رفعها المستخدم
    public function uploadedFiles()
    {
        return $this->hasMany(File::class, 'uploaded_by');
    }

    // التعليقات التي كتبها المستخدم
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    // التقييمات التي أجراها المستخدم
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'evaluator_id');
    }
}