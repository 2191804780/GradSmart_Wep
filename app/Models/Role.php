<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // تعطيل التوقيت الافتراضي لـ Laravel (لأن الجدول يحتوي فقط على created_at)
    public $timestamps = false;

>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
    protected $fillable = [
        'role_name',
        'description',
    ];

<<<<<<< HEAD
    public $timestamps = false;

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
=======
    // علاقة الدور بالمستخدمين: الدور الواحد له العديد من المستخدمين (One-to-Many)
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
