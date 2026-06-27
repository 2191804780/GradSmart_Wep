<?php

namespace App\Models;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
<<<<<<< HEAD
=======
    use HasFactory;

    public $timestamps = false; // تعطيل التوقيت الافتراضي لـ Laravel

>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
    protected $fillable = [
        'project_id',
        'task_id',
        'user_id',
        'content',
<<<<<<< HEAD
    ];

    public $timestamps = false;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
=======
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
>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
