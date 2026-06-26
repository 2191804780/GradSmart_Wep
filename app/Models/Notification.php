<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public $timestamps = false; // تعطيل التوقيت الافتراضي لـ Laravel

    // ملاحظة: Laravel يملك جدول notifications خاصاً به، ولذلك نستخدم اسماً صريحاً للجدول
    protected $table = 'notifications';

    protected $fillable = [
        'user_id',
        'message',
        'type',
        'is_read',
        'created_at'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'created_at' => 'datetime'
    ];

    // علاقة الإشعار بالمستخدم الذي أُرسل إليه (Notification belongs to a User)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
