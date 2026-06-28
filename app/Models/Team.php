<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    // تعطيل updated_at لأن الجدول يحتوي فقط على created_at
    public $timestamps = false;

    // الحقول المسموح بإدخالها
    protected $fillable = [
        'name',
        'department_id',
        'invite_code',
        'max_members',
        'supervisor_id',
        'created_by',
        'created_at',
    ];

    // القسم الأكاديمي الذي يتبع له الفريق
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    // المشرف على الفريق
    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    // الطالب الذي أنشأ الفريق
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // أعضاء الفريق
    public function members()
    {
        return $this->belongsToMany(
            User::class,
            'team_members',
            'team_id',
            'user_id'
        )->withPivot('is_leader', 'member_role', 'joined_at');
    }

    // مشروع التخرج الخاص بالفريق
    public function project()
    {
        return $this->hasOne(Project::class, 'team_id');
    }

    // تقييمات الفريق
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'team_id');
    }
}