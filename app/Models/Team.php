<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

<<<<<<< HEAD
=======
    public $timestamps = false; // تعطيل التوقيت الافتراضي لـ Laravel

>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
    protected $fillable = [
        'name',
        'department_id',
        'invite_code',
        'max_members',
        'supervisor_id',
        'created_by',
<<<<<<< HEAD
    ];

    public $timestamps = false;

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

=======
        'created_at'
    ];

    // علاقة الفريق بالقسم الأكاديمي (Team belongs to a Department)
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    // علاقة الفريق بالمشرف المسند إليه (Team belongs to a Supervisor)
>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

<<<<<<< HEAD
=======
    // علاقة الفريق بمنشئه (طالب) (Team was created by a User)
>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

<<<<<<< HEAD
    public function members()
    {
        return $this->belongsToMany(
         User::class, 
        'team_members',
        'team_id', 
        'user_id'
        
        ) ->withPivot('is_leader' , 'member_role' , 'joined_at');
    }

    public function project()
    {
        return $this->hasOne(Project::class);
    }
}
=======
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
>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
