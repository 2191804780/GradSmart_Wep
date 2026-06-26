<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    public $timestamps = false; // تعطيل التوقيت الافتراضي لـ Laravel

    // نحدد اسم الجدول يدوياً لأن Laravel سيبحث افتراضياً عن جدول باسم activity_logs (جمع)
    protected $table = 'activity_log';

    protected $fillable = [
        'user_id',
        'action',
        'entity_type',
        'entity_id',
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
