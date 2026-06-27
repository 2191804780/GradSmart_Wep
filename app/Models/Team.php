<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'department_id',
        'invite_code',
        'max_members',
        'supervisor_id',
        'created_by',
    ];

    public $timestamps = false;

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

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