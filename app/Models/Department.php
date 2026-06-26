<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    // تعطيل التوقيت الافتراضي لـ Laravel (لأن الجدول يحتوي فقط على created_at)
    public $timestamps = false;

    protected $fillable = [
        'name',
        'code',
        'description',
    ];

    // القسم الأكاديمي الواحد ينتمي إليه العديد من المستخدمين (طلاب أو أعضاء هيئة تدريس)
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // القسم الأكاديمي الواحد يحتوي على العديد من الفرق
    public function teams()
    {
        return $this->hasMany(Team::class);
    }
}
