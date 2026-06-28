<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    // تعطيل التوقيت لأن جدول roles لا يحتوي غالبًا على created_at و updated_at
    public $timestamps = false;

    // الحقول المسموح بتعبئتها
    protected $fillable = [
        'name',
        'description',
    ];

    // الدور الواحد يمكن أن ينتمي له عدة مستخدمين
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}