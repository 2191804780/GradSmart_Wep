<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    // تعطيل التوقيت الافتراضي لأن الجدول يستخدم sent_at بدل created_at و updated_at
    public $timestamps = false;

    // الحقول المسموح بتعبئتها
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'content',
        'is_read',
        'sent_at',
    ];

    // تحويل أنواع البيانات تلقائياً
    protected $casts = [
        'is_read' => 'boolean',
        'sent_at' => 'datetime',
    ];

    // علاقة الرسالة بالمستخدم الذي أرسلها
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // علاقة الرسالة بالمستخدم الذي استقبلها
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}