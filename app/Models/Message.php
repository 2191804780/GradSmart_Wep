<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public $timestamps = false; // تعطيل التوقيت الافتراضي لـ Laravel

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'content',
        'is_read',
        'sent_at'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'sent_at' => 'datetime'
    ];

    // علاقة الرسالة بمرسلها (Message belongs to a Sender User)
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // علاقة الرسالة بمستلمها (Message belongs to a Receiver User)
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
