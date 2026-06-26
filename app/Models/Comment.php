<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public $timestamps = false; // تعطيل التوقيت الافتراضي لـ Laravel

    protected $fillable = [
        'project_id',
        'task_id',
        'user_id',
        'content',
        'created_at'
    ];

    protected $casts = [
        'created_at' => 'datetime'
    ];

    // علاقة التعليق بالمشروع (التعليق قد يكون على مشروع - قيمة اختيارية)
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    // علاقة التعليق بالمهمة (التعليق قد يكون على مهمة - قيمة اختيارية)
    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    // علاقة التعليق بكاتبه (Comment belongs to a User)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
