<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false; // تعطيل التوقيت الافتراضي لـ Laravel

    protected $fillable = [
        'student_id',
        'name',
        'email',
        'password',
        'role_id',
        'profile_image',
        'is_active',
        'created_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'is_active' => 'boolean',
            'created_at' => 'datetime',
        ];
    }

    // علاقة المستخدم بالدور (User belongs to a Role)
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    // علاقة الطالب بالفرق (طالب واحد قد ينضم لعدة فرق عبر جدول team_members)
    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_members', 'user_id', 'team_id')
                    ->withPivot('is_leader', 'joined_at');
    }

    // علاقة المشرف بالفرق التي يشرف عليها (Supervisor oversees many Teams)
    public function supervisedTeams()
    {
        return $this->hasMany(Team::class, 'supervisor_id');
    }

    // علاقة منشئ الفريق بالفرق التي أنشأها
    public function createdTeams()
    {
        return $this->hasMany(Team::class, 'created_by');
    }

    // علاقة المستخدم بالمهام المكلف بها (User is assigned many Tasks)
    public function assignedTasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    // علاقة المستخدم بالمهام التي أنشأها (User created many Tasks)
    public function createdTasks()
    {
        return $this->hasMany(Task::class, 'created_by');
    }

    // علاقة المستخدم بالملفات التي رفعها
    public function uploadedFiles()
    {
        return $this->hasMany(File::class, 'uploaded_by');
    }

    // علاقة المستخدم بالتعليقات التي كتبها
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    // علاقة المستخدم (المقّيم) بالتقييمات التي أجراها
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'evaluator_id');
    }

    // علاقة المستخدم بالإشعارات الخاصة به
    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id');
    }

    // علاقة المستخدم بالرسائل المرسلة منه
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    // علاقة المستخدم بالرسائل المستلمة إليه
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    // علاقة المستخدم بسجل أنشطته
    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class, 'user_id');
    }
}
