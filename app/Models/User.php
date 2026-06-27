<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        'department_id',
        'is_department_head',
        'created_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

        public function supervisedTeams()
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

    public function createdTeams()
    {
        return $this->hasMany(Team::class, 'created_by');
    }

    public function supervisedProjects()
    {
        return $this->hasMany(Project::class, 'supervisor_id');
    }
    

      public function teams(): BelongsToMany
    {
    return $this->belongsToMany(
        Team::class,
        'team_members',
        'user_id',
        'team_id'
    )->withPivot('is_leader', 'joined_at');
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function supervisorRequests()
    {
    return $this->hasMany(SupervisorRequest::class, 'supervisor_id');
    }

}
