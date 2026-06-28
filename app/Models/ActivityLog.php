<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    // اسم الجدول في قاعدة البيانات
    protected $table = 'activity_log';

    // تعطيل التوقيت الافتراضي لأن الجدول يستخدم timestamp بدل created_at و updated_at
    public $timestamps = false;

    // الحقول المسموح بتعبئتها
    protected $fillable = [
        'user_id',
        'action',
        'entity_type',
        'entity_id',
        'timestamp',
    ];

    // تحويل timestamp إلى تاريخ تلقائياً
    protected $casts = [
        'timestamp' => 'datetime',
    ];

    // علاقة سجل النشاط بالمستخدم
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}