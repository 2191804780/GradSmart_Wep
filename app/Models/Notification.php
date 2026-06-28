<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    // اسم الجدول في قاعدة البيانات
    protected $table = 'notifications';

    // تعطيل التوقيت الافتراضي لأن الجدول يستخدم created_at فقط
    public $timestamps = false;

    // الحقول المسموح بتعبئتها
    protected $fillable = [
        'user_id',
        'message',
        'type',
        'is_read',
        'created_at',
    ];

    // تحويل أنواع البيانات تلقائياً
    protected $casts = [
        'is_read' => 'boolean',
        'created_at' => 'datetime',
    ];

    // علاقة الإشعار بالمستخدم الذي استقبل الإشعار
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}