<?php

namespace App\Models;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
<<<<<<< HEAD
=======
    use HasFactory;

    public $timestamps = false; // تعطيل التوقيت الافتراضي لـ Laravel

    // ملاحظة: Laravel يملك جدول notifications خاصاً به، ولذلك نستخدم اسماً صريحاً للجدول
    protected $table = 'notifications';

>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
    protected $fillable = [
        'user_id',
        'message',
        'type',
        'is_read',
<<<<<<< HEAD
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
=======
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
>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
