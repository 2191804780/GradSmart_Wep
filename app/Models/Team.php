<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public $timestamps = false; // تعطيل التوقيت الافتراضي لـ Laravel

    protected $fillable = [
        'name',
        'department_id',
        'invite_code',
        'max_members',
        'supervisor_id',
        'created_by',
        'created_at'
    ];

    // علاقة الفريق بالقسم الأكاديمي (Team belongs to a Department)
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    // علاقة الفريق بالمشرف المسند إليه (Team belongs to a Supervisor)
    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    // علاقة الفريق بمنشئه (طالب) (Team was created by a User)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // علاقة الفريق بأعضائه (الطلاب) (Team has many Users)
    public function members()
    {
        return $this->belongsToMany(User::class, 'team_members', 'team_id', 'user_id')
                    ->withPivot('is_leader', 'joined_at');
    }

    // علاقة الفريق بمشروع التخرج الخاص به (Team has one Project)
    public function project()
    {
        return $this->hasOne(Project::class, 'team_id');
    }

    // علاقة الفريق بالتقييمات التي حصل عليها (Team has many Evaluations)
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'team_id');
    }
}
