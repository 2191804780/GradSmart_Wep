<?php

namespace App\Models;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
<<<<<<< HEAD
=======
    use HasFactory;

    public $timestamps = false; // تعطيل التوقيت الافتراضي لـ Laravel

>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'content',
        'is_read',
<<<<<<< HEAD
        'sent_at',
    ];

    public $timestamps = false;

    public function sender()
{
    return $this->belongsTo(User::class, 'sender_id');
}

public function receiver()
{
    return $this->belongsTo(User::class, 'receiver_id');
}
}
=======
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
>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
