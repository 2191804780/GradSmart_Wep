<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    // تعطيل التوقيت الافتراضي لـ Laravel (لأن الجدول يحتوي فقط على created_at)
    public $timestamps = false;

>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
    protected $fillable = [
        'name',
        'code',
        'description',
    ];

<<<<<<< HEAD
    public $timestamps = false;

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }
}
=======
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
>>>>>>> 7cdfcbbcf8653648d8c141c38b63f18a621a6c45
