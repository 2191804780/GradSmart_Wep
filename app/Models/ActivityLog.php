<?php

namespace App\Models;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
<<<<<<< HEAD
=======
    use HasFactory;

    public $timestamps = false; // تعطيل التوقيت الافتراضي لـ Laravel

    // نحدد اسم الجدول يدوياً لأن Laravel سيبحث افتراضياً عن جدول باسم activity_logs (جمع)
>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
    protected $table = 'activity_log';

    protected $fillable = [
        'user_id',
        'action',
        'entity_type',
        'entity_id',
<<<<<<< HEAD
        'timestamp',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
=======
        'timestamp'
    ];

    protected $casts = [
        'timestamp' => 'datetime'
    ];

    // علاقة سجل النشاط بالمستخدم الذي قام بالفعل (قد يكون NULL للأفعال التلقائية)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
