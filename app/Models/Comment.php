<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // تعطيل التوقيت الافتراضي لأن الجدول لا يحتوي على updated_at
    public $timestamps = false;

    // الحقول المسموح بتعبئتها
    protected $fillable = [
        'project_id',
        'task_id',
        'user_id',
        'content',
        'created_at',
    ];

    // تحويل تاريخ الإنشاء إلى كائن تاريخ
    protected $casts = [
        'created_at' => 'datetime',
    ];

    // التعليق قد يكون مرتبطًا بمشروع
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    // التعليق قد يكون مرتبطًا بمهمة
    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    // كاتب التعليق
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}